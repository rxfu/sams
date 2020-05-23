@extends('layouts.app')

@section('title', __('Show') . __('log.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('log.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('log.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-3 col-form-label text-right">{{ __('log.created_at') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->created_at }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('log.user_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->user)->username }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ip" class="col-sm-3 col-form-label text-right">{{ __('log.ip') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->ip }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="code" class="col-sm-3 col-form-label text-right">{{ __('log.code') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->code }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="path" class="col-sm-3 col-form-label text-right">{{ __('log.path') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->path }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="method" class="col-sm-3 col-form-label text-right">{{ __('log.method') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->method }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-sm-3 col-form-label text-right">{{ __('log.action') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->action }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model" class="col-sm-3 col-form-label text-right">{{ __('log.model') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->model }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model_id" class="col-sm-3 col-form-label text-right">{{ __('log.model_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->model_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label text-right">{{ __('log.content') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->content }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
