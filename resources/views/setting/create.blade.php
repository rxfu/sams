@extends('layouts.app')

@section('title', __('Create') . __('setting.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('setting.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('settings.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('setting.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('setting.name') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="value" class="col-sm-3 col-form-label text-right">{{ __('setting.value') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" id="value" placeholder="{{ __('setting.value') }}" value="{{ old('value') }}" required>
                            @error('value')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('setting.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="{{ __('setting.description') }}">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
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
