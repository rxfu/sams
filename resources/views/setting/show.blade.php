@extends('layouts.app')

@section('title', __('Show') . __('setting.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('setting.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('setting.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('setting.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="value" class="col-sm-3 col-form-label text-right">{{ __('setting.value') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->value }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">{{ __('setting.description') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->description }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('settings.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('settings.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </a>
                    @endcan
                </div>
            </div>
            @can('delete', $item)
                <form id="delete-form" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection
