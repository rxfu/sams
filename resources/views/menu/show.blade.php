@extends('layouts.app')

@section('title', '显示' . __('menu.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('menu.module') }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="uid" class="col-sm-3 col-form-label">{{ __('menu.uid') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="uid" id="uid" value="{{ $item->uid }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">{{ __('menu.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">{{ __('menu.description') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="description" id="description" value="{{ $item->description }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label">{{ __('menu.is_enable') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_enable" id="is_enable" value="{{ $item->is_enable }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-foot">
                <a href="{{ route('menus.edit', $item->getKey()) }}" title="编辑" class="btn btn-info">
                    <i class="icon fa fa-edit"></i> 编辑
                </a>
                <a href="{{ route('menus.destroy', $item->getKey()) }}" class="btn btn-danger btn-flat btn-sm" title="删除" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                    <i class="icon fa fa-trash"></i> 删除
                </a>
            </div>
            <form id="delete-form" action="{{ route('menus.destroy', $item->getKey()) }}" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
@endsection
