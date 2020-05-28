@extends('layouts.app')

@section('title', __('Show') . __('archive.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('archive.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('archive.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sid" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->sid }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="card_number" class="col-sm-3 col-form-label text-right">{{ __('archive.card_number') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->card_number }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="received_at" class="col-sm-3 col-form-label text-right">{{ __('archive.received_at') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->received_at }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('archive.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('archive.department_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->department)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('archive.major_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->major)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('archive.grade') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->grade }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="creator_id" class="col-sm-3 col-form-label text-right">{{ __('archive.creator_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->creator)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editor_id" class="col-sm-3 col-form-label text-right">{{ __('archive.editor_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->editor)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('archive.remark') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->remark }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('archives.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('archives.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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
