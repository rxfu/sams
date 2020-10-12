@extends('layouts.app')

@section('title', __('Show') . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('user.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('user.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.username') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->username }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-sm-3 col-form-label text-right">{{ __('user.role') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->present()->allRoles }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="group" class="col-sm-3 col-form-label text-right">{{ __('user.group') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->present()->allGroups }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('user.phone') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->phone }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->email }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department" class="col-sm-3 col-form-label text-right">{{ __('user.department') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->department->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="major" class="col-sm-3 col-form-label text-right">{{ __('user.major') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->present()->allMajors }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('user.is_enable') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->present()->isEnable }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_super" class="col-sm-3 col-form-label text-right">{{ __('user.is_super') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->present()->isSuper }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_login_at" class="col-sm-3 col-form-label text-right">{{ __('user.last_login_at') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->last_login_at }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @unless($item->is_super)
                        @can('update', $item)
                            <a href="{{ route('users.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                            </a>
                        @endcan
                        &nbsp;&nbsp;
                        @can('delete', $item)
                            <a href="{{ route('users.destroy', $item) }}" class="btn btn-danger delete" title="删除" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                            </a>
                        @endcan
                    @endunless
                </div>
            </div>
            @unless($item->is_super)
                @can('delete', $item)
                    <form id="delete-form" method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                @endcan
            @endunless
        </div>
    </div>
</div>
@endsection
