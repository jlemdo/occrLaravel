<?php
namespace App\Console\Commands;

use App\Models\Transcription;
use Aws\TranscribeService\TranscribeServiceClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PollTranscriptionResults extends Command
{
    protected $signature = 'transcriptions:poll';

    protected $description = 'Poll for transcription results from AWS Transcribe';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $transcriptions = Transcription::whereNull('transcription_text')->get();

        if ($transcriptions->isEmpty()) {
            $this->info('No transcriptions to process.');
            return;
        }

        $transcribeClient = new TranscribeServiceClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        foreach ($transcriptions as $transcription) {
            $jobName = 'transcription-' . basename($transcription->audio_file, '.mp3');
            $result = $transcribeClient->getTranscriptionJob([
                'TranscriptionJobName' => $jobName,
            ]);

            if ($result['TranscriptionJob']['TranscriptionJobStatus'] === 'COMPLETED') {
                $transcriptionUrl = $result['TranscriptionJob']['Transcript']['TranscriptFileUri'];
                $transcriptionContent = file_get_contents($transcriptionUrl);
                $transcriptionText = json_decode($transcriptionContent, true)['results']['transcripts'][0]['transcript'];

                $transcription->transcription_text = $transcriptionText;
                $transcription->save();

                $this->info('Transcription completed for file: ' . $transcription->audio_file);
            } elseif ($result['TranscriptionJob']['TranscriptionJobStatus'] === 'FAILED') {
                $this->error('Transcription failed for file: ' . $transcription->audio_file);
            }
        }
    }
}
