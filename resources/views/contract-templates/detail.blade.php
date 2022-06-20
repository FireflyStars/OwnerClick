@extends('layouts.app', ['activePage' => 'contract-templates', 'titlePage' => __('dashboard.property_management_screen')])

@section('content')
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card card-profile">
                                <img style="width: 100%;" class="img" src="https://maps.googleapis.com/maps/api/staticmap?size=600x400&markers=icon%3Ahttp%3A%2F%2Fwww.google.com%2Fmapfiles%2Farrow.png%7C41.39479%2C2.148768&visible=41.320004%2C2.069526%7C41.469576%2C2.22801&key=AIzaSyD-5o7tSPJ0gOWHbpoMncApIktYHcqR0_E">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-pills-icons" role="tablist">
                                <!--
                                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                -->
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#dashboard-1">
                                        <i class="material-icons">dashboard</i>
                                        Kiraya Ver
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#schedule-1">
                                        <i class="material-icons">add</i>
                                        {{__('dashboard.contract')}}
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#tasks-1">
                                        <i class="material-icons">list</i>
                                        {{__('dashboard.fixture')}}
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#dashboard-1">
                                        <i class="material-icons">alarm</i>
                                        {{__('dashboard.reminder')}}
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#schedule-1">
                                        <i class="material-icons">file_copy</i>
                                        {{__('dashboard.files')}}
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a class="nav-link" href="#tasks-1">
                                        <i class="material-icons">build</i>
                                        Düzenle
                                    </a>
                                </li>
                            </ul>
                            <a href="#pablo" class="btn btn-info btn-round">Follow</a>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">{{__('dashboard.tenants')}}</h4>
                            <p class="card-category">Bu gayrimenkuldeki son 5 kiracı</p>
                        </div>
                        <div class="card-body table-responsive">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">store</i>
                                    </div>
                                    <p class="card-category">{{__('dashboard.rent_fee')}}</p>
                                    <h3 class="card-title">1200TL</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> {{__('dashboard.payment_day')}} :
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">store</i>
                                    </div>
                                    <p class="card-category">{{__('dashboard.dept_amount')}}</p>
                                    <h3 class="card-title">2400TL</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> {{__('dashboard.due_date')}} : 05.10.2019
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header  card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">assignment</i>
                                    </div>
                                    <p class="card-category">{{__('dashboard.days_remaining')}}</p>
                                    <h3 class="card-title">160</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i> Kira {{__('dashboard.new')}}leme Durumu : Belirsiz
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tabs card-header-info">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link  active show" href="#profile" data-toggle="tab">
                                                        <i class="material-icons">my_location</i> {{__('dashboard.address_information')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#messages" data-toggle="tab">
                                                        <i class="material-icons">house</i> {{__('dashboard.detail')}} Bilgi


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#settings" data-toggle="tab">
                                                        <i class="material-icons">assignment</i> {{__('dashboard.contracts')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#payment" data-toggle="tab">
                                                        <i class="material-icons">attach_money</i> {{__('dashboard.payments')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#tenant" data-toggle="tab">
                                                        <i class="material-icons">person</i> {{__('dashboard.tenants')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#fixture" data-toggle="tab">
                                                        <i class="material-icons">event_seat</i> {{__('dashboard.fixtures')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#expenses" data-toggle="tab">
                                                        <i class="material-icons">format_paint</i> {{__('dashboard.outgoings')}}


                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#notes" data-toggle="tab">
                                                        <i class="material-icons">note</i> {{__('dashboard.nots')}}


                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="profile">
                                            <table class="table">
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.type')}}</td>
                                                    <td>{{$property->getTypeName()}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.country')}}</td>
                                                    <td>{{$property->country->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.state')}}</td>
                                                    <td>{{$property->state->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.city')}}</td>
                                                    <td>{{$property->city->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Mahalle</td>
                                                    <td>{{$property->region}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Bina No</td>
                                                    <td>{{$property->building_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Kat</td>
                                                    <td>{{$property->floor}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Daire No</td>
                                                    <td>{{$property->apartment_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Posta Kodu</td>
                                                    <td>{{$property->zip_code}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.address')}}</td>
                                                    <td>{{$property->address}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="messages">
                                            <table class="table">
                                                <tr>
                                                    <td class="font-weight-bold">Bina Kodu</td>
                                                    <td>34512335</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Enlem/Boylam</td>
                                                    <td>40.9903/29.0205</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.rent_fee')}}</td>
                                                    <td>800TL</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">m2</td>
                                                    <td>75m2 (Brüt) 60m2(Net)</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Oda</td>
                                                    <td>1+1</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.status')}}</td>
                                                    <td>Kirada</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="settings">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{__('dashboard.contract_type')}}</th>
                                                    <th>{{__('dashboard.contract_date')}}</th>
                                                    <th>{{__('dashboard.end_date')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sozlesmeler as $sozlesme)
                                                    <tr>
                                                        <td>{{$sozlesme['id']}}</td>
                                                        <td>{{$sozlesme['tip']}}</td>
                                                        <td>{{$sozlesme['baslangic_tarihi']}}</td>
                                                        <td>{{$sozlesme['bitis_tarihi']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="payment">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tür</th>
                                                    <th>İşlem</th>
                                                    <th>{{__('dashboard.amount')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($odemeler as $odeme)
                                                    <tr>
                                                        <td>{{$odeme['id']}}</td>
                                                        <td>{{$odeme['tur']}}</td>
                                                        <td>{{$odeme['islem']}}</td>
                                                        <td>{{$odeme['tutar']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="tenant">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{__('dashboard.tenant')}}</th>
                                                    <th>{{__('dashboard.start_date')}}</th>
                                                    <th>{{__('dashboard.end_date')}}</th>
                                                    <th>{{__('dashboard.deposit')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kiracilar as $kiraci)
                                                    <tr>
                                                        <td>{{$kiraci['id']}}</td>
                                                        <td>{{$kiraci['kiraci']}}</td>
                                                        <td>{{$kiraci['baslangic']}}</td>
                                                        <td>{{$kiraci['bitis']}}</td>
                                                        <td>{{$kiraci['depozito']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="fixture">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{__('dashboard.how_many')}}</th>
                                                    <th>{{__('dashboard.fixture')}}</th>
                                                    <th>{{__('dashboard.comment')}}</th>
                                                    <th>{{__('dashboard.status')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kiracilar as $kiraci)
                                                    <tr>
                                                        <td>{{$kiraci['id']}}</td>
                                                        <td>{{$kiraci['kiraci']}}</td>
                                                        <td>{{$kiraci['baslangic']}}</td>
                                                        <td>{{$kiraci['bitis']}}</td>
                                                        <td>{{$kiraci['depozito']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="expenses">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{__('dashboard.how_many')}}</th>
                                                    <th>{{__('dashboard.fixture')}}</th>
                                                    <th>{{__('dashboard.comment')}}</th>
                                                    <th>{{__('dashboard.status')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kiracilar as $kiraci)
                                                    <tr>
                                                        <td>{{$kiraci['id']}}</td>
                                                        <td>{{$kiraci['kiraci']}}</td>
                                                        <td>{{$kiraci['baslangic']}}</td>
                                                        <td>{{$kiraci['bitis']}}</td>
                                                        <td>{{$kiraci['depozito']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="notes">
                                            <table class="table table-hover">
                                                <thead class="text-info">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{__('dashboard.how_many')}}</th>
                                                    <th>{{__('dashboard.fixture')}}</th>
                                                    <th>{{__('dashboard.comment')}}</th>
                                                    <th>{{__('dashboard.status')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kiracilar as $kiraci)
                                                    <tr>
                                                        <td>{{$kiraci['id']}}</td>
                                                        <td>{{$kiraci['kiraci']}}</td>
                                                        <td>{{$kiraci['baslangic']}}</td>
                                                        <td>{{$kiraci['bitis']}}</td>
                                                        <td>{{$kiraci['depozito']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function (event) {

        var data = {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            series: [
                [1200, 1200, 1200, 1200, 1200, 1200, 1200, 1200, 1200, 1200]
            ]
        };

        var options = {
            height: '200px',
        };

        new Chartist.Bar('#dailySalesChart', data, options);
    })

</script>
