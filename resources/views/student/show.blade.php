@extends('layouts.app')

@section('title', __('Show') . __('student.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('student.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('student.id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->id }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('student.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="card_type" class="col-sm-3 col-form-label text-right">{{ __('student.card_type') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->card_type }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="card_id" class="col-sm-3 col-form-label text-right">{{ __('student.card_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->card)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-sm-3 col-form-label text-right">{{ __('student.gender') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->gender }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nation" class="col-sm-3 col-form-label text-right">{{ __('student.nation') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->nation }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('student.department_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->department)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('student.major_id') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ optional($item->major)->name }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('student.grade') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->grade }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duration" class="col-sm-3 col-form-label text-right">{{ __('student.duration') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->duration }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label text-right">{{ __('student.status') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->status }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="level" class="col-sm-3 col-form-label text-right">{{ __('student.level') }}</label>
                    <div class="col-sm-9">
                        <div class="form-control-plaintext">{{ $item->level }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('students.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('students.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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
