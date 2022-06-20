@extends('layouts.app', ['activePage' => 'files', 'titlePage' => __('dashboard.fixtures')])

@section('content')
    <?php
    /**
     * @var \App\Models\File $files
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
                            <h4 class="card-title">{{__('dashboard.fixtures')}}</h4>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('files.create') }}" data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal" data-href="{{ route('files.create') }}" class="btn  btn-info"> <i
                                            class="material-icons">add</i>
                                        {{__('dashboard.create_fixture')}}</a>
                                </div>
                            </div>
                            <div class="table-reponse-temp">
                                <table class="table dataTable" style="width:100%">
                                    <thead class=" text-info">
                                    <th>ID</th>
                                    <th>{{__('dashboard.name')}}</th>
                                    <th>{{__('dashboard.how_many')}}</th>
                                    <th>{{__('dashboard.property')}}</th>
                                    <th>{{__('dashboard.status')}}</th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>
                                                {{$file->id}}
                                            </td>
                                            <td>
                                                {{$file->name}}
                                            </td>
                                            <td>
                                                {{$file->count}}
                                            </td>
                                            <td>
                                                {{$file->property->name}}
                                            </td>
                                            <td>
                                                {!! $file->getStats(true) !!}
                                            </td>
                                            <td class="td-actions text-right">
                                                <form action="{{ route('files.destroy', $file) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a rel="tooltip" class="btn  btn-link"
                                                       href="{{ route('files.show', $file) }}"
                                                       data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>

                                                    </a>

                                                    <a rel="tooltip" class="btn  btn-link"
                                                       href="{{ route('files.edit', $file) }}"
                                                       data-original-title="" title="">
                                                        <i class="material-icons">edit</i>

                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-link"
                                                            data-original-title="" title=""
                                                            onclick="confirm('{{ __("Bu demirbaşı silmek istediğinize emin misiniz?") }}') ? this.parentElement.submit() : ''">
                                                        <i class="material-icons">close</i>

                                                    </button>
                                                </form>

                                            </td>
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
@endsection
