<?php

namespace App\Http\Controllers;

use App\Events\ContractRenewed;
use App\Http\Requests\ContractRenewalRequest;
use App\Http\Requests\ContractTerminateRequest;
use App\Models\ContractChange;
use App\Models\ContractPersons;
use App\Models\ContractTemplate;
use App\Models\ContractTerminate;
use App\Models\Detail;
use App\Models\File;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Models\Note;
use App\Models\Outgoing;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Person;
use App\Models\UnitPerson;
use App\Models\TenantSilinecek;
use App\Models\Timezone;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ContractController extends Controller
{

    /**
     * @param Contract $contract
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['contract'] = Contract::find($id);
        return view('contracts.detail', $data);
    }

    /**
     * @param Contract $contract
     * @return \Illuminate\View\View
     */
    public function index(Contract $contract)
    {

        $data = [
            'contracts' => $contract->paginate(15),
            'forRentCount' => $contract->query()->count()
        ];
        return view('contracts.index', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'contract' => new Contract(),
            'formMethod' => 'post',
            'formAction' => 'contracts.store'
        ];
        return view('contracts.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Contract $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContractRequest $request)
    {

//        header('Content-Type' , 'application/pdf');
//        $templates = ContractTemplate::query()->find($request->contract_template_id)->template;
        //$templates= preg_replace('/({{ŞEHİR}})/', $request->rental_price, $templates);

//        $pdf = new Dompdf();
//        $pdf->loadHtml($templates);
//        $pdf->render();
//        $pdf->stream('MyForm.pdf',array("Attachment" => false));
//        $request->validate([
//            'contractTemplateFile' => 'required|mimes:csv,txt,xlx,xls,pdf,doc,odt,docx|max:2048'

        //        ]);
        DB::beginTransaction();
        try {
            $activeCount = Contract::query()->where('unit_id', $request->get('unit_id'))->where('status_id', Contract::CONTRACT_STATUS_ACTIVE)->count();
            if ($activeCount > 0) {
                $result = ['status' => false, 'message' => ['type' => 'errors', 'title' =>__('alert.active_contract_available'), 'text' => __('alert.active_contract_available_description')]];
                return \response()->json($result);
            }
            $contract = Contract::create($request->merge(['status_id' => Contract::CONTRACT_STATUS_ACTIVE, 'creator_id' => Auth::id()])->all());
            if ($contract->id != null) {

                foreach ($request->person_id as $key => $value) {
                    if ($request->person_id[$key]) {
                        $contractPersons = new ContractPersons();
                        $contractPersons->contract_id = $contract->id;
                        $contractPersons->person_id = $request->person_id[$key];
                        $contractPersons->creator_id = Auth::id();
                        $contractPersons->type_id = $request->type_id[$key];
                        if ($request->type_id[$key] == ContractPersons::CONTRACT_PERSONS_TYPE_TENANT or $request->type_id[$key] == ContractPersons::CONTRACT_PERSONS_TYPE_OWNER) {
                            $contractPersons->share = $request->share[$key];
                        }
                        $contractPersons->status_id = UnitPerson::UNIT_PERSONS_STATUS_ACTIVE;
                        $contractPersons->save();
                    }
                }


                $ownerPersons = UnitPerson::query()->where('unit_id', $request->get('unit_id'))->where('type_id', UnitPerson::UNIT_PERSONS_TYPE_OWNER)->get(['person_id']);
                foreach ($ownerPersons as $person) {
                    $contractPersons = new ContractPersons();
                    $contractPersons->contract_id = $contract->id;
                    $contractPersons->person_id = $person->person_id;
                    $contractPersons->creator_id = Auth::id();
                    $contractPersons->type_id = ContractPersons::CONTRACT_PERSONS_TYPE_OWNER;
                    $contractPersons->share = $person->share;
                    $contractPersons->status_id = UnitPerson::UNIT_PERSONS_STATUS_ACTIVE;
                    $contractPersons->save();
                }

                $startedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $contract->start_date);
                $endedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date);
                $diffMonth = Carbon::now()->diffInMonths($startedDateCarbon);

                $depositPayment = new PaymentDept();
                $depositPayment->creator_id = Auth::id();
                $depositPayment->contract_id = $contract->id;
                $depositPayment->payment_method_id = (int)$contract->payment_method_id;
                $depositPayment->payment_account_id = $contract->payment_account_id;
                $depositPayment->payment_type_id = Payment::PAYMENT_TYPE_DEPOSIT;
                $depositPayment->amount = $contract->deposit_price;
                $depositPayment->currency = $contract->deposit_currency;
                $depositPayment->due_date = $startedDateCarbon->format(\auth()->user()->date_format);
                $depositPayment->comment = $contract->start_date . " Depozito Ödemesi";
                $depositPayment->status_id = PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT;
                $depositPayment->save();

                $startedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $contract->start_date);
                $endedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date);
                Contract::createPaymentDepts($contract, $startedDateCarbon, $endedDateCarbon);
            }


//            $fileModel = new File();
//
//            if ($request->file()) {
//                $filePath = Storage::disk('local')->put('contract', $request->file('contractTemplateFile'));
//                $fileModel->name = time() . '_' . $request->file->getClientOriginalName();
//                $fileModel->path = $filePath;
//                $fileModel->creator_id = Auth::id();
//                $fileModel->type_id = File::FILE_TYPE_UNIT_CONTRACT;
//                $fileModel->unit_id = $request->get('unit_id');
//                $fileModel->contract_id = $contract->id;
//                $fileModel->hash = md5($filePath);
//                $fileModel->title = "Sözleşme";
//                $fileModel->upload_date = Now();
//                $fileModel->save();
//                $contract->file_id = $fileModel->id;
//                $contract->save();
//            }

            $files = (array)\Illuminate\Support\Facades\Request::input('files');

            foreach ($files as $file) {
                $fileUpdate = File::find($file);
                $fileUpdate->temp = 0;
                $fileUpdate->contract_id = $contract->id;
                $fileUpdate->unit_id = $request->get('unit_id');
                $fileUpdate->save();
            }




            DB::commit();
        } catch (ValidationException $e) {
            DB::rollBack();
            $result = ['status' => false, 'message' => ['type' => 'error', 'title' => __('alert.error_occurred'), 'text' => $e->getMessage()]];
            return \response()->json($result);

//            $result = ['status' => false, 'message' => ['type' => 'error', 'title' => 'Hata', 'text' => 'Sözleşme başarıyla oluşturuldu.']];
//            return \response()->json($result);
        }

        $result = ['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.contract_created_successfully')]];
        return \response()->json($result);
    }

    /**
     * @param \App\Models\Contract $contract
     * @return \Illuminate\View\View
     */
    public function edit(Contract $contract)
    {
        $data = [
            'contract' => $contract,
            'formMethod' => 'PUT',
            'formAction' => 'contracts.update'
        ];

        return view('contracts.create', $data);
    }

    /**
     * @param \App\Http\Requests\ContractRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());

        return redirect()->route('contracts.index')->withStatus(__('alert.property_updated_successfully'));
    }

    /**
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contract $contract)
    {

        $contract->delete();

        $result = ['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' =>__('alert.contract_deleted_successfully')]];
        return \response()->json($result);
    }


    public function terminate(ContractTerminateRequest $request, $id)
    {


        $terminate = new ContractTerminate();
        $terminate->contract_id = $id;
        $terminate->creator_id = Auth::id();
        $terminate->date = Carbon::createFromFormat(\auth()->user()->date_format, $request->date);
        $terminate->reason = $request->reason;
        $terminate->save();

        $contract = Contract::query()->find($id);
        $contract->status_id = Contract::CONTRACT_STATUS_CANCELED;
        $contract->contract_terminate_id = $terminate->id;
        $contract->update(['status_id']);

        UnitPerson::query()
            ->where('unit_id', $contract->unit_id)
            ->where('type_id', UnitPerson::UNIT_PERSONS_TYPE_TENANT)
            ->where('status_id', UnitPerson::UNIT_PERSONS_STATUS_ACTIVE)
            ->update(['status_id' => UnitPerson::UNIT_PERSONS_STATUS_PASSIVE]);


        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.contract_terminated_successfully')]]);


    }


    public function getRenewal($id)
    {
        $contract = Contract::find($id);
        $newContract = new \stdClass();

        switch ($contract->payment_period) {
            case Contract::PAYMENT_PERIOD_DAILY:
                $newContract->end_date = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date)->addDay()->format(\auth()->user()->date_format);
                break;
            case Contract::PAYMENT_PERIOD_MONTHLY:
                $newContract->end_date = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date)->addYear()->format(\auth()->user()->date_format);
                break;
            case Contract::PAYMENT_PERIOD_3_MONTHLY:
                $newContract->end_date = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date)->addYear()->format(\auth()->user()->date_format);
                break;
            case Contract::PAYMENT_PERIOD_6_MONTHLY:
                $newContract->end_date = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date)->addYear()->format(\auth()->user()->date_format);
                break;
            case Contract::PAYMENT_PERIOD_YEARLY:
                $newContract->end_date = Carbon::createFromFormat(\auth()->user()->date_format, $contract->end_date)->addYear()->format(\auth()->user()->date_format);
                break;
        }
        $contract->rental_price_radio = 10;
        $data = [
            'contract' => $contract,
            'newContract' => $newContract,
            'formMethod' => 'post',
            'formAction' => 'contract.renewal'
        ];
        return view('contracts.renewal', $data);

    }

    public function renewal(ContractRenewalRequest $request, $id)
    {
        $contract = Contract::find($id);
        $contract->payment_period = (int)$request->get('payment_period');
        $contract->rental_price = $request->get('rental_price');
        $start_date = $contract->end_date;
        $contract->end_date = $request->get('end_date');
        $contract->save();
        $startedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $start_date);
        $endedDateCarbon = Carbon::createFromFormat(\auth()->user()->date_format, $request->get('end_date'));
        Contract::createPaymentDepts($contract, $startedDateCarbon, $endedDateCarbon);
        $event = new ContractRenewed($contract);
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.success_contract_renew')]]);

    }


}
