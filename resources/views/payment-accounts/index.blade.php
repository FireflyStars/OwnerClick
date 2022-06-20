@extends('layouts.app', ['activePage' => 'payment-accounts', 'titlePage' => __('dashboard.bank_accounts')])

@section('content')
    <?php
    /**
     * @var \App\Models\Property $paymentAccounts
     */
    ?>
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">{{__('dashboard.bank_accounts')}}</h4>
                        </div>
                        <div class="card-body card-menu">
                                @if(count($paymentAccounts) > 0)
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('payment-accounts.create') }}" data-toggle="modal"
                                       data-target="#ajaxModal" data-redirect="true"
                                       data-href="{{ route('payment-accounts.create') }}"
                                       data-redirect-target="#ajax-content" data-redirect-href="/payment-accounts"
                                       class="btn  btn-info mobile-fixed-circle-button"> <i
                                            class="material-icons">add</i>
                                        <span class="d-none d-sm-inline-block">{{__('dashboard.new_payment_account')}}</span></a> </div>

                            </div>
                                @endif
                                @if(count($paymentAccounts) == 0)
                                    <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                                        <i class="fas fa-money-check-alt fa-6x"></i>
                                        <h3>{{__('dashboard.add_your_payment_account')}}</h3>
                                        <span class="description">{{__('dashboard.add_your_payment_account_description')}}</span>
                                        <div class=" m-3">
                                            <a href="{{ route('payment-accounts.create') }}" data-toggle="modal"
                                               data-target="#ajaxModal" data-redirect="true"
                                               data-href="{{ route('payment-accounts.create') }}"
                                               data-redirect-target="#ajax-content" data-redirect-href="/payment-accounts"
                                               class="btn  btn-info "> <i
                                                    class="material-icons">add</i>
                                                <span>{{__('dashboard.new_payment_account')}}</span></a>
                                        </div>
                                    </div>
                                @else
                            <div class="table-reponse-temp">
                                <table class="table dataTable" style="width:100%">
                                    <thead class=" text-info">
                                    <th class="d-none d-sm-table-cell">ID</th>
                                    <th>{{__('dashboard.record_name')}}</th>
                                    <th class="d-none d-sm-table-cell">{{__('dashboard.iban')}}</th>
                                    <th class="text-right">{{__('dashboard.actions')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($paymentAccounts as $paymentAccount)
                                        <tr>
                                            <td class="d-none d-sm-table-cell">
                                                {{$paymentAccount['id']}}
                                            </td>

                                            <td>
                                                <b>{{$paymentAccount['account_name']}}</b>
                                                @mobile
                                                -
                                                {{$paymentAccount['iban']}}
                                                @endmobile
                                                <br/>
                                                {{$paymentAccount['owner_name']}}

                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                {{$paymentAccount['iban']}}
                                            </td>
                                            <td class="td-actions text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                                       id="navbarContractActionMenu{{$paymentAccount->id}}"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="true">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="navbarContractActionMenu{{$paymentAccount->id}}">
                                                        <a rel="tooltip" class="dropdown-item"
                                                           href="{{ route('payment-accounts.show', $paymentAccount) }}"
                                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                                           data-redirect="true"
                                                           data-href="{{ route('payment-accounts.show', $paymentAccount) }}"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>{{__('dashboard.viewing_payment_account')}}
                                                        </a>
                                                        <a rel="tooltip" class="dropdown-item"
                                                           href="{{ route('payment-accounts.edit', $paymentAccount) }}"
                                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                                           data-redirect="true"
                                                           data-href="{{ route('payment-accounts.edit', $paymentAccount) }}"
                                                           data-redirect-target="#ajax-content" data-redirect-href="/payment-accounts"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">edit</i>{{__('dashboard.edit_account')}}
                                                        </a>
                                                        <a class="dropdown-item btn-delete-confirm"
                                                           data-href="{{route('payment-accounts.destroy', $paymentAccount) }}"
                                                           data-redirect="true"
                                                           data-redirect-target="#ajax-content" data-redirect-href="/payment-accounts"
                                                           data-text="{{$paymentAccount->account_name}}/{{$paymentAccount->iban}}">
                                                            <i class="material-icons">close</i>{{__('dashboard.delete_account')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
