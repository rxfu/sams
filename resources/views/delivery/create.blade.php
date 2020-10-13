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
                                    <option value="{{ $collection->getKey() }}">{{ $collection->getKey() }} - {{ $collection->sid }}（{{ optional($collection->student)->name }}）</option>
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
                        <label for="reason" class="col-sm-3 col-form-label text-right">{{ __('delivery.reason') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" placeholder="{{ __('delivery.reason') }}" value="{{ old('reason') }}">
                            @error('reason')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right">{{ __('delivery.status') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="status" id="status0" class="form-check-input @error('status') is-invalid @enderror" value="0" checked>
                                <label class="form-check-label" for="status0">未投递</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="status" id="status1" class="form-check-input @error('status') is-invalid @enderror" value="1">
                                <label class="form-check-label" for="status1">已投递</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="status" id="status2" class="form-check-input @error('status') is-invalid @enderror" value="2">
                                <label class="form-check-label" for="status2">被退回</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ems" class="col-sm-3 col-form-label text-right">{{ __('delivery.ems') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('ems') is-invalid @enderror" name="ems" id="ems" placeholder="{{ __('delivery.ems') }}" value="{{ old('ems') }}">
                            @error('ems')
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
                        <label for="zipcode" class="col-sm-3 col-form-label text-right">{{ __('delivery.zipcode') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" id="zipcode" placeholder="{{ __('delivery.zipcode') }}" value="{{ old('zipcode') }}">
                            @error('zipcode')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="send_at" class="col-sm-3 col-form-label text-right">{{ __('delivery.send_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker @error('send_at') is-invalid @enderror" name="send_at" id="send_at" placeholder="{{ __('delivery.send_at') }}" value="{{ old('send_at') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('send_at')
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
