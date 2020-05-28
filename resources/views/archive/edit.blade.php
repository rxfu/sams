@extends('layouts.app')

@section('title', __('Edit') . __('archive.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('archive.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('archives.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="sid" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('sid') is-invalid @enderror" name="sid" id="sid" placeholder="{{ __('archive.sid') }}" value="{{ old('sid', $item->sid) }}">
                            @error('sid')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="card_number" class="col-sm-3 col-form-label text-right">{{ __('archive.card_number') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" id="card_number" placeholder="{{ __('archive.card_number') }}" value="{{ old('card_number', $item->card_number) }}">
                            @error('card_number')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="received_at" class="col-sm-3 col-form-label text-right">{{ __('archive.received_at') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('received_at') is-invalid @enderror" name="received_at" id="received_at" placeholder="{{ __('archive.received_at') }}" value="{{ old('received_at', $item->received_at) }}">
                            @error('received_at')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('archive.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('archive.name') }}" value="{{ old('name', $item->name) }}">
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('archive.department_id') }}</label>
                        <div class="col-sm-9">
                            @inject('departments', 'App\Services\DepartmentService')
							<select name="department_id" id="department_id" class="form-control select2 select2-info @error('department_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($departments->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('department_id', $item->department_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('archive.major_id') }}</label>
                        <div class="col-sm-9">
                            @inject('majors', 'App\Services\MajorService')
							<select name="major_id" id="major_id" class="form-control select2 select2-info @error('major_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($majors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('major_id', $item->major_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('major_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('archive.grade') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" id="grade" placeholder="{{ __('archive.grade') }}" value="{{ old('grade', $item->grade) }}">
                            @error('grade')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="creator_id" class="col-sm-3 col-form-label text-right">{{ __('archive.creator_id') }}</label>
                        <div class="col-sm-9">
                            @inject('creators', 'App\Services\CreatorService')
							<select name="creator_id" id="creator_id" class="form-control select2 select2-info @error('creator_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($creators->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('creator_id', $item->creator_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('creator_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="editor_id" class="col-sm-3 col-form-label text-right">{{ __('archive.editor_id') }}</label>
                        <div class="col-sm-9">
                            @inject('editors', 'App\Services\EditorService')
							<select name="editor_id" id="editor_id" class="form-control select2 select2-info @error('editor_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($editors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('editor_id', $item->editor_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('editor_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('archive.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" rows="5" placeholder="{{ __('archive.remark') }}">{{ old('remark', $item->remark) }}</textarea>
                            @error('remark')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection