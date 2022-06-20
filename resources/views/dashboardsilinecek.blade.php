@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Used Space</p>
              <h3 class="card-title">{{$totalAmount}}
                <small>/{{$totalPayment}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
{{--        <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--          <div class="card card-stats">--}}
{{--            <div class="card-header card-header-info card-header-icon">--}}
{{--              <div class="card-icon">--}}
{{--                <i class="material-icons">store</i>--}}
{{--              </div>--}}
{{--              <p class="card-category">Revenue</p>--}}
{{--              <h3 class="card-title">$34,245</h3>--}}
{{--            </div>--}}
{{--            <div class="card-footer">--}}
{{--              <div class="stats">--}}
{{--                <i class="material-icons">date_range</i> Last 24 Hours--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
          <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <canvas id="myChart" width="50" height="50" data-total="{{$totalPayment}}" data-current="{{$totalAmount}}" ></canvas>

                  <div class="card-header card-header-info card-header-icon">

                      <p class="card-category">{{__('dashboard.received')}}</p>
                      <h3 class="card-title">{{$totalAmount}}</h3>
                  </div>
                  <div class="card-footer">
                      <div class="stats">
                          <i class="material-icons">date_range</i> Son 30 Gün
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Fixed Issues</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fab fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Bugs

                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Website

                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Server

                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Employees Stats</h4>
              <p class="card-category">New employees on 15th September, 2016</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-info">
                    <tr>
                        <th>Tür</th>
                        <th>Ödenen/Toplam Tutar</th>
                        <th>{{__('dashboard.due_date')}}</th>
                        <th>{{__('dashboard.status')}}</th>
                        <th class="text-right">{{__('dashboard.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>
                                <b>{!! \App\Models\Payment::getPaymentTypes()[$payment->payment_type_id]['name']!!}</b>
                                <div class="d-inline-block d-sm-none">{{$payment->due_date}}</div>
                            </td>
                            <td>{{$payment->amountOfDept}}/{{$payment->amount}}{{$payment->currency}}</td>
                            <td class="d-none d-sm-table-cell">{{$payment->due_date}}</td>
                            @if($payment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE )
                                <td>{!! $payment->getStatus(true) !!}</td>
                            @else
{{--                                <td>{!! $payment->getStatusForAmount($payment->amount,$payment->amountOfDept,$payment->due_date,true) !!}</td>--}}
                                <td>{!! $payment->getStatus(true) !!}</td>
                            @endif
                            <td class="text-right">
                                <div class="dropdown float-right">
                                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                       id="navbarContractActionMenu{{$payment->id}}"
                                       data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="true">
                                        <i class="material-icons">more_vert</i>
                                    </a>
{{--                                    <div class="dropdown-menu"--}}
{{--                                         aria-labelledby="navbarContractActionMenu{{$payment->id}}">--}}
{{--                                        @if($payment->status_id == \App\Models\PaymentDept::PAYMENT_STATUS_CANCELED)--}}
{{--                                            <a class="dropdown-item"--}}
{{--                                               href="{{route('payments.passive', $payment) }}"--}}
{{--                                               data-href="{{route('payments.passive', $payment) }}"--}}
{{--                                               data-toggle="ajax"--}}
{{--                                               data-push-history="false"--}}
{{--                                               data-redirect-target="#propertyDetailContent"--}}
{{--                                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                               data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                                <i class="material-icons">history</i>İptali {{__('dashboard.back')}} Al--}}
{{--                                            </a>--}}
{{--                                        @else--}}
{{--                                            <a rel="tooltip" href="{{ route('payments.create') }}"--}}
{{--                                               data-toggle="modal"--}}
{{--                                               data-target="#ajaxModal" data-redirect="true"--}}
{{--                                               data-href="{{ route('payments.create', $payment) }}?unit_id={{$unit_id}}&ref_payment_id={{$payment->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"--}}
{{--                                               data-redirect-target="#propertyDetailContent"--}}
{{--                                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                               class="dropdown-item"> <i class="material-icons">check</i>--}}
{{--                                                {{__('dashboard.report_payment')}}</a>--}}
{{--                                            <a rel="tooltip" href="{{ route('payments.show',$payment) }}?unit_id={{$unit_id}}"--}}
{{--                                               data-toggle="modal"--}}
{{--                                               data-target="#ajaxModal" data-redirect="true"--}}
{{--                                               data-href="{{ route('payments.show', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                               data-redirect-target="#propertyDetailContent"--}}
{{--                                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                               class="dropdown-item"> <i class="material-icons">visibility</i>--}}
{{--                                                {{__('dashboard.payment')}} {{__('dashboard.details')}}ı</a>--}}
{{--                                            <a rel="tooltip" class="dropdown-item "--}}
{{--                                               href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                               data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
{{--                                               data-redirect="true"--}}
{{--                                               data-href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                               data-redirect-target="#propertyDetailContent"--}}
{{--                                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                               data-original-title="" title="">--}}
{{--                                                <i class="material-icons">edit</i>{{__('dashboard.edit_payment')}}--}}
{{--                                            </a>--}}
{{--                                            <a class="dropdown-item btn-cancel-confirm"--}}
{{--                                               data-href="{{route('payments.cancel', $payment) }}"--}}
{{--                                               data-redirect="true"--}}
{{--                                               data-redirect-target="#propertyDetailContent"--}}
{{--                                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                               data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                                <i class="material-icons">money_off</i>{{__('dashboard.payment')}} İptal Et--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                        <a class="dropdown-item btn-delete-confirm"--}}
{{--                                           data-href="{{route('payments.destroy', $payment) }}"--}}
{{--                                           data-redirect="true"--}}
{{--                                           data-redirect-target="#propertyDetailContent"--}}
{{--                                           data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                           data-text="{{$payment->payment_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                            <i class="material-icons">close</i>{{__('dashboard.delete_payment')}}--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
              <table class="table table-hover">
                <thead class="text-info">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Salary</th>
                  <th>Country</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script src="{{mix('js/charts.js')}}"></script>
{{--  <script>--}}
{{--    $(document).ready(function() {--}}
{{--      // Javascript method's body can be found in assets/js/demos.js--}}
{{--      md.initDashboardPageCharts();--}}
{{--    });--}}
{{--  </script>--}}
@endpush
