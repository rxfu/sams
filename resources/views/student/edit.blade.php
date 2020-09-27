@extends('layouts.app')

@section('title', __('Edit') . __('student.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('student.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('students.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('student.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('student.name') }}" value="{{ old('name', $item->name) }}">
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="card_type" class="col-sm-3 col-form-label text-right">{{ __('student.card_type') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('card_type') is-invalid @enderror" name="card_type" id="card_type" placeholder="{{ __('student.card_type') }}" value="{{ old('card_type', $item->card_type) }}">
                            @error('card_type')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="card_id" class="col-sm-3 col-form-label text-right">{{ __('student.card_id') }}</label>
                        <div class="col-sm-9">
                            @inject('cards', 'App\Services\CardService')
							<select name="card_id" id="card_id" class="form-control select2 select2-info @error('card_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                @foreach ($cards->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('card_id', $item->card_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('card_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-sm-3 col-form-label text-right">{{ __('student.gender') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" placeholder="{{ __('student.gender') }}" value="{{ old('gender', $item->gender) }}">
                            @error('gender')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nation" class="col-sm-3 col-form-label text-right">{{ __('student.nation') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nation') is-invalid @enderror" name="nation" id="nation" placeholder="{{ __('student.nation') }}" value="{{ old('nation', $item->nation) }}">
                            @error('nation')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('student.department_id') }}</label>
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
                        <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('student.major_id') }}</label>
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
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('student.grade') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" id="grade" placeholder="{{ __('student.grade') }}" value="{{ old('grade', $item->grade) }}">
                            @error('grade')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="duration" class="col-sm-3 col-form-label text-right">{{ __('student.duration') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" placeholder="{{ __('student.duration') }}" value="{{ old('duration', $item->duration) }}">
                            @error('duration')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right">{{ __('student.status') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="status" placeholder="{{ __('student.status') }}" value="{{ old('status', $item->status) }}">
                            @error('status')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label text-right">{{ __('student.level') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('level') is-invalid @enderror" name="level" id="level" placeholder="{{ __('student.level') }}" value="{{ old('level', $item->level) }}">
                            @error('level')
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
