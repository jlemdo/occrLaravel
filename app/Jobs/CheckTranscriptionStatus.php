<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Aws\TranscribeService\TranscribeServiceClient;
use App\Models\Transcription;

class CheckTranscriptionStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transcription;

    public $tries = 10; //
	public $backoff = [60, 120, 300];

    public function __construct(Transcription $transcription)
    {
        $this->transcription = $transcription;
    }

    public function handle()
    {
        $transcribeClient = new TranscribeServiceClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $result = $transcribeClient->getTranscriptionJob([
                'TranscriptionJobName' => $this->transcription->transcription_job_name,
            ]);

            $status = $result['TranscriptionJob']['TranscriptionJobStatus'];

            if ($status == 'COMPLETED') {
                $transcriptionUrl = $result['TranscriptionJob']['Transcript']['TranscriptFileUri'];
                $transcriptionData = file_get_contents($transcriptionUrl);  // Ensure this URL is accessible
                $transcriptionJson = json_decode($transcriptionData, true);
                $transcriptionText = $transcriptionJson['results']['transcripts'][0]['transcript'];

                $this->transcription->transcription_text = $transcriptionText;
                $this->transcription->status = 'completed';
                $this->transcription->save();
            } elseif ($status == 'FAILED') {
                $this->transcription->status = 'failed';
                $this->transcription->save();
            } else {
                // Re-dispatch the job to check later
                self::dispatch($this->transcription)->delay(now()->addMinutes(5));
            }
        } catch (Exception $e) {
            // Log the exception and fail the job if necessary
            \Log::error('Error checking transcription status: ' . $e->getMessage());
            $this->fail($e);
        }
    }
}