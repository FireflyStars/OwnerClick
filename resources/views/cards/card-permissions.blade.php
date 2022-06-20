<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Yetkiler</h4>
    </div>
    <div class="card-body">
        <div class="table-reponse-temp">
            <table class="table dataTable" style="width:100%">
                <thead class=" text-info">
                <th>ID</th>
                <th class="w-100">{{__('dashboard.type')}}</th>
                @foreach ($permissionGroups as $permissionGroup => $subPermissions)
                <th class="text-center border-left border-right"
                    colspan="{{count($subPermissions)}}">
                    <div class="permissionTitle">{{ucwords($permissionGroup)}}</div>
                    <div class="permission-group">
                        @foreach ($subPermissions as $permission)
                        @switch($permission)
                        @case('detail')
                        <i class="text-gray material-icons">book</i>
                        @break
                        @case('assignment')
                        <i class="text-gray material-icons">assignment</i>
                        @break
                        @case('payments')
                        <i class="text-gray material-icons">attach_money</i>
                        @break
                        @case('person')
                        <i class="text-gray material-icons">person</i>
                        @break
                        @case('fixture')
                        <i class="text-gray material-icons">event_seat</i>
                        @break
                        @case('expense')
                        <i class="text-gray material-icons">format_paint</i>
                        @break
                        @case('note')
                        <i class="text-gray material-icons">note</i>
                        @break
                        @case('file')
                        <i class="text-gray material-icons">file_copy</i>
                        @break
                        @case('owner')
                        <i class="text-gray material-icons">person</i>
                        @break
                        @endswitch
                        @endforeach
                    </div>
                </th>
                @endforeach
                </thead>
                <tbody>
                @foreach(\App\Models\Person::all() as $person)
                    <tr>
                <td>{{$person->id}}</td>
                <td> {{$person->name}}</td>
                @foreach ($permissions as $permission)
                <td class=px-1">
                    <a class="change-permission" href="#" data-target="{{route('permission.change',['user_id'=>$person->id, 'permission_name'=>$permission->name])}}" data-permission-id="{{@$permission->id}}" data-user-id="{{@$permission->id}}">
                        <i class="cursor-pointer text-gray material-icons rectangle-check {{(!auth()->user()->can($permission->name))?'rectangle-not-check':''}}">{{(auth()->user()->can($permission->name))?'check':'clear'}}</i>
                    </a>
                </td>
                @endforeach
                <td></td>
                @endforeach
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12">
                    <button id="addUserToPermission" type="button" class="btn btn-outline-info btn-sm pull-right">Kullanıcı Ekle
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
