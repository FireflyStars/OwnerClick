<?php

namespace App\Console\Commands;

use App\Events\NearContractExpires;
use App\Events\PaymentDelayed;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\User;
use App\Notifications\PaymentDelayedNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DetectNearContractExpires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownerclick:notify:near-contract-expires {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Belirlenen gün farkına bakarak sözleşmesi yaklaşan sözleşmeler için bildirim gönderir.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $diffDay = $this->argument('day');
        $start = now();
        $this->comment('Processing');
        $carbon = Carbon::now()->addDays($diffDay -1 );
        $contracts = Contract::query()
            ->whereIn('status_id',[Contract::CONTRACT_STATUS_ACTIVE])
            ->whereDate('end_date','>', $carbon->format('Y-m-d'))
            ->whereDate('end_date', '<=',$carbon->addDays(1)->format('Y-m-d'))
            ->get();
        foreach ($contracts as $contract) {
            $createdTime = Carbon::createFromFormat('Y-m-d H:i:s', $contract->created_at)->format('H:i:s');
            $diffInHours = Carbon::now()->diff($createdTime)->h;
            if ($diffInHours === 0) {
                $user = User::find($contract->creator_id);
                Auth::login($user);
                $event = new NearContractExpires($contract, $diffDay);
                Auth::logout();
            }
        }
        $time = $start->diffInMilliseconds(now());
        $message = $start->format('d-m-Y h:i:s') . " $this->signature $diffDay execute in $time miliseconds";
        $this->comment($message);
        Log::info($message);
    }


}
