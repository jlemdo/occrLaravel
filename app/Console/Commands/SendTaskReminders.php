<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Leadtask; // Adjust to your model namespace
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
class SendTaskReminders extends Command
{
    protected $signature = 'send:task-reminders';
    protected $description = 'Send reminders for tasks due in less than 24 hours';

    public function handle()
    {
        $now = Carbon::now();
$nextDay = $now->copy()->addDay();


$tasks = Leadtask::whereRaw("STR_TO_DATE(CONCAT(date, ' ', time), '%Y-%m-%d %H:%i') <= ?", [$nextDay])
    ->whereRaw("STR_TO_DATE(CONCAT(date, ' ', time), '%Y-%m-%d %H:%i') > ?", [$now])
    ->get();

if ($tasks->isEmpty()) {
    $this->info('No tasks due within the next 24 hours.');
} else {
    $this->info('Found ' . $tasks->count() . ' tasks.');
}
//$user = \App\Models\User::find($task->leadid);

        foreach ($tasks as $task) {
             $lead = \App\Models\Leads::where('id', $task->leadid)->first();
			 $user = \App\Models\User::find($lead->assigned_to);
            if ($user) {
                $user->notify(new TaskReminderNotification($task));
				Mail::to($user->email)->send(new \App\Mail\TaskReminderMail($task));
            }
        }

        $this->info('Task reminders sent 123 successfully.');
    }
}
