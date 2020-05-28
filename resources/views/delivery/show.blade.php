@extends('layouts.app')

@section('title', __('Show') . __('delivery.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('delivery.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('delivery.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="archive_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.archive_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->archive)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="forward" class="col-sm-3 col-form-label text-right">{{ __('delivery.forward') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->forward }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label text-right">{{ __('delivery.status') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->status }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="receiver" class="col-sm-3 col-form-label text-right">{{ __('delivery.receiver') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->receiver }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('delivery.phone') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->phone }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label text-right">{{ __('delivery.address') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->address }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="had_receipt" class="col-sm-3 col-form-label text-right">{{ __('delivery.had_receipt') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->had_receipt }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="creator_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.creator_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->creator)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editor_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.editor_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->editor)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="version" class="col-sm-3 col-form-label text-right">{{ __('delivery.version') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->version }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('delivery.remark') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->remark }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('deliveries.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('deliveries.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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
