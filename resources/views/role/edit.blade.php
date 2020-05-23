@extends('layouts.app')

@section('title', __('Edit') . __('role.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('role.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('roles.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('role.slug') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="{{ __('role.slug') }}" value="{{ old('slug', $item->slug) }}" required>
                            @error('slug')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('role.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('role.name') }}" value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('role.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('roles', 'App\Services\RoleService')
							<select name="parent_id" id="parent_id" class="form-control select2 select2-info @error('parent_id') is-invalid @enderror" data-dropdown-css-class="select2-info">
                                <option value=""{{ old('parent_id', $item->parent_id) === '' ? ' selected' : '' }}>无</option>
                                @foreach ($roles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('parent_id', $item->parent_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <label for="by_group" class="col-sm-3 col-form-label text-right">{{ __('role.by_group') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="by_group" id="by_group1" class="form-check-input @error('by_group') is-invalid @enderror" value="1"{{ old('by_group', $item->by_group) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="by_group1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="by_group" id="by_group0" class="form-check-input @error('by_group') is-invalid @enderror" value="0"{{ old('by_group', $item->by_group) == 0 ? ' checked' : '' }}>
                                <label class="form-check-label" for="by_group0">否</label>
                            </div>
                            @error('by_group')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('role.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="{{ __('role.description') }}">{{ old('description', $item->description) }}</textarea>
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
