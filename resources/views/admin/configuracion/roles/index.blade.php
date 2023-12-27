@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.roles.css.css')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Roles') }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('roles.create')
                                <a href="{{ route('roles.create') }}" type="button" class="btn-transition btn btn-outline-primary"
                                    title="{{ __('Add Role') }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($roles) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="80%">{{ __('Name') }}</th>
                                        <th width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>

                                            <td>
                                                @can('roles.edit')
                                                    <a href="{{ route('roles.edit', $role) }}" title="{{ __('Edit Role') }}"
                                                        type="button" class="btn btn-outline-success btn-sm">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('roles.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $role->id }}"
                                                        data-record-title="{{ 'el rol ' }}{{ $role->name }}"
                                                        data-action="{{ route('roles.destroy', $role->id) }}"
                                                        title="{{ __('Delete Role') }}" class="btn btn-outline-danger btn-sm">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="trash-2" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
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
@endsection
@section('modal')
    @include('admin.modales.eliminar')
@endsection

@section('js')
    @include('admin.configuracion.roles.js.js')
@endsection
