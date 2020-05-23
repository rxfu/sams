@extends('layouts.app')

@section('title', __('Create') . __('group.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('group.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('groups.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('group.slug') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="{{ __('group.slug') }}" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('group.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('group.name') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('group.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('groups', 'App\Services\GroupService')
							<select name="parent_id" id="parent_id" class="form-control select2 select2-success @error('parent_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                <option value="">无</option>
                                @foreach ($groups->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('group.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="{{ __('group.description') }}">{{ old('description') }}</textarea>
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
