<?php

namespace App\Http\Controllers;

use App\Events\PaymentCreated;
use App\Models\Contract;
use App\Models\Detail;
use App\Models\Event;
use App\Models\Note;
use App\Models\Outgoing;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Models\User;
use App\Notifications\AlertNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([ 'auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

//        $payment = new Payment();
//        broadcast(new PaymentCreated($payment));
        return redirect()->route('dashboard');
        $authenticatable = Auth::user();
        $authenticatable->notify(new \App\Notifications\PaymentCreatedNotification());

        return view('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request, $unitId = null)
    {

        $data = Payment::payments($unitId);


        // drakify('success');
        // smilify('success', 'You are successfully reconnected');
        //emotify('success', 'You are awesome, your data was successfully created');


//        die;
        //        broadcast(new PaymentCreated($payment));
        if ($request->ajax()) {
            return view('dashboard', $data)->renderSections()['content'];
        } else {
            if ($unitId) {
                return view('units.detail', $data);
            }
            return view('dashboard', $data);

        }

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function payments(Request $request, $unitId = null)
    {

        if ($request->get('period') == 'daily') {
            $beforeDate = Carbon::now()->addMonths(-1);
            $afterDate = Carbon::now()->addMonths(1);
            $period = 'Ymd';
        } else {
            $beforeDate = Carbon::now()->addMonths(-9)->startOfMonth();
            $afterDate = Carbon::now()->addMonths(3)->endOfMonth();
            $period = 'Ym';
        }
        //YearlyPayment İçin Tasarlandı
        if ($unitId == null) {
            $yearlyPaymentBuilder = Payment::query();
            $yearlyPaymentDeptBuilder = PaymentDept::query();
            $yearlyOutgoingBuilder = Outgoing::query();
        } else {
            $yearlyPaymentBuilder = Payment::query()->join('contracts', 'contracts.id', '=', 'payments.contract_id')->where('unit_id', $unitId);
            $yearlyPaymentDeptBuilder = PaymentDept::query()->join('contracts', 'contracts.id', '=', 'payment_depts.contract_id')->where('unit_id', $unitId);
            $yearlyOutgoingBuilder = Outgoing::query()->where('unit_id', $unitId);
        }
        $yearlyOutgoings = $yearlyOutgoingBuilder->whereBetween('outgoing_date', [$beforeDate, $afterDate])
            ->orderBy('outgoing_date', 'desc')->select(['outgoings.id', DB::raw('"outgoing" AS status_id'), 'outgoings.outgoing_date as payment_date', 'outgoings.outgoing_date as due_date', 'outgoings.amount', DB::raw('true as active'), DB::raw('null as ref_payment_id')]);

        $yearlyPayments = $yearlyPaymentBuilder->where(function ($query) use ($beforeDate, $afterDate) {
            $query->whereBetween('payment_date', [$beforeDate, $afterDate])->orderBy('payment_date', 'desc');
        })->unionAll($yearlyOutgoings)->unionAll($yearlyPaymentDeptBuilder->where(function ($query) use ($beforeDate, $afterDate) {
            $query->whereBetween('due_date', [$beforeDate, $afterDate])->orderBy('due_date', 'desc');
        })->select(['payment_depts.id', DB::raw('"payment_depts" AS status_id'), 'due_date', 'due_date as payment_date', 'amount', 'active', 'payment_depts.id as ref_payment_id']))
            ->get(['payments.id', 'payments.status_id', 'payments.payment_date', 'due_date', 'amount', 'active', 'ref_payment_id'])->all();


        $yearlyPaymentData = [];
        $payment_date_timestamp = 0;
        $due_date_timestamp = 0;
        foreach ($yearlyPayments as $payment) {

            if (!is_null($payment->payment_date)) {
                $payment_date_timestamp = Carbon::createFromFormat(\auth()->user()->date_format, $payment->payment_date)->format($period);
            }

            if (!is_null($payment->due_date)) {
                $due_date_timestamp = Carbon::createFromFormat(\auth()->user()->date_format, $payment->due_date)->format($period);
            }

            if (!isset($yearlyPaymentData[$payment_date_timestamp])) {
                $yearlyPaymentData[$payment_date_timestamp] = ['x' => $payment_date_timestamp, 'paid' => 0, 'outgoing' => 0, 'waiting' => 0, 'canceled' => 0, 'id' => []];
            }

            if (!isset($yearlyPaymentData[$due_date_timestamp])) {
                $yearlyPaymentData[$due_date_timestamp] = ['x' => $due_date_timestamp, 'paid' => 0, 'outgoing' => 0, 'waiting' => 0, 'canceled' => 0, 'id' => []];
            }
            switch ($payment->status_id) {
                case 'outgoing':
                    $yearlyPaymentData[$payment_date_timestamp]['outgoing'] += $payment->amount;
                    break;
                case PaymentDept::PAYMENT_STATUS_PAID:
                    $yearlyPaymentData[$payment_date_timestamp]['paid'] += $payment->amount;
                    break;
                case 'payment_depts':
                    $yearlyPaymentData[$due_date_timestamp]['waiting'] += $payment->amount;
                    break;
            }
        }

        ksort($yearlyPaymentData);
        $yearlyPaymentData = array_values($yearlyPaymentData);
        $result = [
            'data' => $yearlyPaymentData,
            'legends' => [__('dashboard.outgoing'), __('dashboard.credit'), __('dashboard.amount')]
        ];
        echo json_encode($result);
        die;
    }


    public function overdue($unitId = null)
    {
        $payments = Payment::query()
            ->with(['contract:id,unit_id', 'contract.unit:id,name,property_id', 'contract.unit.property:id,name'])
            ->whereNull('ref_payment_id')
            ->where('due_date', '<', Carbon::now()->format('Y-m-d'))
            ->orderBy('id', 'desc')
            ->get()->all();


        $data = [];
        foreach ($payments as $payment) {
            if ($payment->status_id != PaymentDept::PAYMENT_STATUS_CANCELED) {
                if (!isset($data[$payment->contract->unit_id])) {
                    $data[$payment->contract->unit_id] = ['overdueAmount' => 0, 'unit' => $payment->contract->unit->property->name . "/" . $payment->contract->unit->name, 'currency' => $payment->currency];
                }

                $data[$payment->contract->unit_id]['overdueAmount'] += ($payment->amount - $payment->amountOfDept);
            }
        }

        //        broadcast(new PaymentCreated($payment));
        $data = array_values($data);
        echo json_encode($data);
        die;
    }


    public function nearExpires()
    {
        $nearExpiry = Contract::query()->with(['unit:id,name,property_id,type_id', 'unit.property:id,name'])->where('status_id', '!=', Contract::CONTRACT_STATUS_CANCELED)->orderBy('end_date', 'asc')->limit(7)->get();
        $data['nearExpiry'] = $nearExpiry;
        return view('cards.card-nearExpiries-info', $data);
    }

    public function lastNotes($unit_id = null)
    {
        $data['unit_id'] = $unit_id;
        if ($unit_id == null) {
            $notes = Note::query()->orderBy('created_at', 'desc')->limit(5)->get()->all();
        } else {
            $notes = Note::query()->orderBy('created_at', 'desc')->where('unit_id', $unit_id)->get()->all();
        }
        $data['notes'] = $notes;
        $data['dashboard'] = true;
        return view('tables.notes', $data);
    }

    public function lastPayments($unit_id = null)
    {
        $data['unit_id'] = $unit_id;
        if ($unit_id == null) {
            $latestPaymentsBuilder = Payment::query()->where('payments.active', '=', PaymentDept::PAYMENT_ACTIVE_TRUE);
        } else {
            $latestPaymentsBuilder = Payment::query()->where('payments.active', '=', PaymentDept::PAYMENT_ACTIVE_TRUE)->join('contracts', 'contracts.id', '=', 'payments.contract_id')->where('unit_id', $unit_id);
        }
        $latestPayments = $latestPaymentsBuilder->where('payments.status_id', PaymentDept::PAYMENT_STATUS_PAID)->orderBy('payments.payment_date', 'desc')->orderBy('payments.id', 'desc')->limit(10)->get(['payments.*'])->all();
        $data['refPayments'] = $latestPayments;
        $data['dashboard'] = true;
        return view('tables.paymentsAmount', $data);
    }

    public function overduePayments($unit_id = null)
    {
        $data['unit_id'] = $unit_id;
        if ($unit_id == null) {
            $paymentDeptsBuilder = PaymentDept::query();
        } else {
            $paymentDeptsBuilder = PaymentDept::query()->join('contracts', 'contracts.id', '=', 'payment_depts.contract_id')->where('unit_id', $unit_id);
        }

        $paymentDepts = $paymentDeptsBuilder->whereIn('payment_depts.status_id', [PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT, PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT])->where('active', PaymentDept::PAYMENT_ACTIVE_TRUE)->orderBy('payment_depts.id', 'desc')->get(['payment_depts.*'])->all();
        $data['paymentDepts'] = $paymentDepts;
        $data['dashboard'] = true;
        return view('tables.payments', $data);
    }


    public function summaryInfo()
    {
        $data = [];
        $payments = PaymentDept::activePayments()->whereDate('due_date', '<', Carbon::now())->whereIn('status_id', [\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT, \App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]);
        $totalAmount = $payments->sum('amount');
        $totalPayment = $payments->sum('amount_dept');
        $data['totalDept'] = $totalAmount - $totalPayment;


        $builder = PaymentDept::activePayments();
        if (\request()->input('start_date')) {
            $builder->whereDate('due_date', '>=', \request()->input('start_date'));
        }
        if (\request()->input('end_date')) {
            $builder->whereDate('due_date', '<=', \request()->input('end_date'));
        }
        $totalAmount = $builder->sum('amount');
        $totalPayment = $builder->sum('amount_dept');


        $data['amountOfDept'] = $totalAmount - $totalPayment;
        $data['totalPayment'] = $totalPayment;
        $data['totalAmount'] = $totalAmount;
        return view('cards.card-summary-info', $data);

    }

    public function paymentDonutChart()
    {
        $builder = PaymentDept::activePayments();
        $builder->whereDate('due_date', '>=', Carbon::now()->startOfMonth());
        $builder->whereDate('due_date', '<=', Carbon::now()->endOfMonth());
        $totalAmount = $builder->sum('amount');
        $totalPayment = $builder->sum('amount_dept');
        $data['amountOfDept'] = $totalAmount - $totalPayment;
        $data['totalPayment'] = $totalAmount;
        $data['totalAmount'] = $totalPayment;
        return view('cards.card-paymentMonthlyDonut-chart', $data);

    }

    public function eventsInfo($unit_id = null)
    {
        if ($unit_id == null) {
            $events = Event::query();
        } else {
            $events = Event::query()->where('eventable_type', Unit::class)->where('eventable_id', $unit_id);
        }
        $events = $events->orderBy('id', 'desc')->limit(30)->get();

        $data = ['events' => $events,'unitId'=>$unit_id];
        return view('cards.card-events-info', $data);

    }

    public function paymentInfo(Unit $unitId=null)
    {
        $data = ['contract' => $unitId->contract];
        return view('cards.card-payment-info', $data);

    }

    public function amountOfDeptInfo(Unit $unitId = null)
    {
        $contracts = Contract::query()
            ->where('unit_id', $unitId->id)
            ->get()
            ->all();
        $paymentsa = PaymentDept::activePayments()->whereIn('payment_depts.contract_id', array_column($contracts, 'id'))->whereDate('due_date', '<', Carbon::now())->whereIn('status_id',[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]);
        $totalAmount = $paymentsa->sum('amount');
        $totalPayment = $paymentsa->sum('amount_dept');
        $data = ['unit' => $unitId,'unit_id'=>$unitId->id,'currency' =>@$contracts[0]->rental_currency];
        $data['amountOfDept'] = $totalAmount - $totalPayment;
        return view('cards.card-amountOfDept-info', $data);

    }




}
