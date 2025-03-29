<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindPatients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-patients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $patients = User::where('role', 'patient')
        ->whereDoesntHave('bookings', function ($query) {
            $query->where('date_time', '>', now());
        })
        ->select('name', 'email')
        ->get();

    Notification::send($patients, new RemindPatientsNotification);

    }
}
