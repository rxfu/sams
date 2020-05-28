@extends('layouts.app')

@section('title', __('Create') . __('delivery.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('delivery.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('deliveries.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="archive_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.archive_id') }}</label>
                        <div class="col-sm-9">
                            @inject('archives', 'App\Services\ArchiveService')
							<select name="archive_id" id="archive_id" class="form-control select2 select2-success @error('archive_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($archives->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @error('archive_id')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="forward" class="col-sm-3 col-form-label text-right">{{ __('delivery.forward') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('forward') is-invalid @enderror" name="forward" id="forward" placeholder="{{ __('delivery.forward') }}" value="{{ old('forward') }}">
                            @error('forward')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right">{{ __('delivery.status') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="status" placeholder="{{ __('delivery.status') }}" value="{{ old('status') }}">
                            @error('status')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="receiver" class="col-sm-3 col-form-label text-right">{{ __('delivery.receiver') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('receiver') is-invalid @enderror" name="receiver" id="receiver" placeholder="{{ __('delivery.receiver') }}" value="{{ old('receiver') }}">
                            @error('receiver')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('delivery.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="{{ __('delivery.phone') }}" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label text-right">{{ __('delivery.address') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="{{ __('delivery.address') }}" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="had_receipt" class="col-sm-3 col-form-label text-right">{{ __('delivery.had_receipt') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="had_receipt" id="had_receipt1" class="form-check-input @error('had_receipt') is-invalid @enderror" value="1" checked>
                                <label class="form-check-label" for="had_receipt1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="had_receipt" id="had_receipt0" class="form-check-input @error('had_receipt') is-invalid @enderror" value="0">
                                <label class="form-check-label" for="had_receipt0">否</label>
                            </div>
                            @error('had_receipt')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="creator_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.creator_id') }}</label>
                        <div class="col-sm-9">
                            @inject('creators', 'App\Services\CreatorService')
							<select name="creator_id" id="creator_id" class="form-control select2 select2-success @error('creator_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($creators->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
                        <label for="editor_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.editor_id') }}</label>
                        <div class="col-sm-9">
                            @inject('editors', 'App\Services\EditorService')
							<select name="editor_id" id="editor_id" class="form-control select2 select2-success @error('editor_id') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($editors->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
                        <label for="version" class="col-sm-3 col-form-label text-right">{{ __('delivery.version') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('version') is-invalid @enderror" name="version" id="version" placeholder="{{ __('delivery.version') }}" value="{{ old('version') }}">
                            @error('version')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('delivery.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" rows="5" placeholder="{{ __('delivery.remark') }}">{{ old('remark') }}</textarea>
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
