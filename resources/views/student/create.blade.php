@extends('layouts.app')

@section('title', __('Create') . __('student.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('student.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('students.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('student.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('student.name') }}" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idtype_id" class="col-sm-3 col-form-label text-right">{{ __('student.idtype_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('idtype_id') is-invalid @enderror" name="idtype_id" id="idtype_id" placeholder="{{ __('student.idtype_id') }}" value="{{ old('idtype_id') }}">
                            @error('idtype_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idnumber" class="col-sm-3 col-form-label text-right">{{ __('student.idnumber') }}</label>
                        <div class="col-sm-9">
                            @inject('cards', 'App\Services\CardService')
							<select name="idnumber" id="idnumber" class="form-control select2 select2-success @error('idnumber') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($cards->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('idnumber')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('student.gender_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('gender_id') is-invalid @enderror" name="gender_id" id="gender_id" placeholder="{{ __('student.gender_id') }}" value="{{ old('gender_id') }}">
                            @error('gender_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nation_id" class="col-sm-3 col-form-label text-right">{{ __('student.nation_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nation_id') is-invalid @enderror" name="nation_id" id="nation_id" placeholder="{{ __('student.nation_id') }}" value="{{ old('nation_id') }}">
                            @error('nation_id')
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
							<select name="department_id" id="department_id" class="form-control select2 select2-success @error('department_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($departments->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
							<select name="major_id" id="major_id" class="form-control select2 select2-success @error('major_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($majors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
                            <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" id="grade" placeholder="{{ __('student.grade') }}" value="{{ old('grade') }}">
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
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" placeholder="{{ __('student.duration') }}" value="{{ old('duration') }}">
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
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="status" placeholder="{{ __('student.status') }}" value="{{ old('status') }}">
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
                            <input type="text" class="form-control @error('level') is-invalid @enderror" name="level" id="level" placeholder="{{ __('student.level') }}" value="{{ old('level') }}">
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
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
