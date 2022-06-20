<?php

namespace App\Console\Commands;

use App\Events\PaymentDelayed;
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

class DetectPaymentDelay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownerclick:notify:payment-delay {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Belirlenen gün farkına bakarak geciken ödemelerin geciktiğini bilgilendirici bildirimler oluşturur.';

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
        $carbon = Carbon::now()->addDays(-$diffDay);
        $payments = PaymentDept::query()
            ->whereIn('status_id',[PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT])
            ->whereDate('due_date','>', $carbon->format('Y-m-d'))
            ->whereDate('due_date', '<=',$carbon->addDays(1)->format('Y-m-d'))
            ->get();
        foreach ($payments as $payment) {
            $createdTime = Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('H:i:s');
            $diffInHours = Carbon::now()->diff($createdTime)->h;
            if ($diffInHours === 0) {
                $user = User::find($payment->creator_id);
                Auth::login($user);
                $event = new PaymentDelayed($payment, $diffDay);
                Auth::logout();
            }
        }
        $time = $start->diffInMilliseconds(now());
        $message = $start->format('d-m-Y h:i:s') . " $this->signature $diffDay execute in $time miliseconds";
        $this->comment($message);
        Log::info($message);
    }


}
