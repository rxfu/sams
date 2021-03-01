@extends('layouts.app')

@section('title', __('Show') . __('history.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('history.module') }}: {{ $item->id }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('history.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('history.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="idtype_id" class="col-sm-3 col-form-label text-right">{{ __('history.idtype_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->idtype_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="idtype" class="col-sm-3 col-form-label text-right">{{ __('history.idtype') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->idtype }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="idnumber" class="col-sm-3 col-form-label text-right">{{ __('history.idnumber') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->idnumber }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('history.gender_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->gender_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-sm-3 col-form-label text-right">{{ __('history.gender') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->gender }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nation_id" class="col-sm-3 col-form-label text-right">{{ __('history.nation_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->nation_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nation" class="col-sm-3 col-form-label text-right">{{ __('history.nation') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->nation }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('history.department_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->department_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department" class="col-sm-3 col-form-label text-right">{{ __('history.department') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->department }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('history.major_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->major_id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="major" class="col-sm-3 col-form-label text-right">{{ __('history.major') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->major }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('history.grade') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->grade }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duration" class="col-sm-3 col-form-label text-right">{{ __('history.duration') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->duration }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="level" class="col-sm-3 col-form-label text-right">{{ __('history.level') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->level }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="archive_id" class="col-sm-3 col-form-label text-right">{{ __('history.archive_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->archive_id }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('histories.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('histories.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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
