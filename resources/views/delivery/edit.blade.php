@extends('layouts.app')

@section('title', __('Edit') . __('delivery.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('delivery.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('deliveries.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="archive_id" class="col-sm-3 col-form-label text-right">{{ __('delivery.archive_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive_id }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sid" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->sid }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="idnumber" class="col-sm-3 col-form-label text-right">{{ __('student.idnumber') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->student->idnumber }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('student.name') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->student->name }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('student.department_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->student->department->name }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('student.major_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->student->major->name }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('student.grade') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->archive->student->grade }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="receiver" class="col-sm-3 col-form-label text-right">{{ __('delivery.receiver') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('receiver') is-invalid @enderror" name="receiver" id="receiver" placeholder="{{ __('delivery.receiver') }}" value="{{ old('receiver', $item->receiver) }}">
                            @error('receiver')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label text-right">{{ __('delivery.address') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="{{ __('delivery.address') }}" value="{{ old('address', $item->address) }}">
                            @error('address')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('delivery.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="{{ __('delivery.phone') }}" value="{{ old('phone', $item->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="zipcode" class="col-sm-3 col-form-label text-right">{{ __('delivery.zipcode') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" id="zipcode" placeholder="{{ __('delivery.zipcode') }}" value="{{ old('zipcode', $item->zipcode) }}">
                            @error('zipcode')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="employment" class="col-sm-3 col-form-label text-right">{{ __('delivery.employment') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('employment') is-invalid @enderror" name="employment" id="employment" placeholder="{{ __('delivery.employment') }}" value="{{ old('employment', $item->employment) }}">
                            @error('employment')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="reason" class="col-sm-3 col-form-label text-right">{{ __('delivery.reason') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" placeholder="{{ __('delivery.reason') }}" value="{{ old('reason', $item->reason) }}">
                            @error('reason')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ems" class="col-sm-3 col-form-label text-right">{{ __('delivery.ems') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('ems') is-invalid @enderror" name="ems" id="ems" placeholder="{{ __('delivery.ems') }}" value="{{ old('ems', $item->ems) }}">
                            @error('ems')
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
                                    <input type="text" class="form-control datepicker @error('send_at') is-invalid @enderror" name="send_at" id="send_at" placeholder="{{ __('delivery.send_at') }}" value="{{ old('send_at', $item->send_at) }}">
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
                        <label for="status" class="col-sm-3 col-form-label text-right">{{ __('delivery.status') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="status" id="status0" class="form-check-input @error('status') is-invalid @enderror" value="0"{{ $item->status === 0 ? ' checked' : '' }}>
                                <label class="form-check-label" for="status0">未寄送</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="status" id="status1" class="form-check-input @error('status') is-invalid @enderror" value="1"{{ $item->status === 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="status1">已寄送</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="status" id="status2" class="form-check-input @error('status') is-invalid @enderror" value="2"{{ $item->status === 2 ? ' checked' : '' }}>
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
                        <label for="had_receipt" class="col-sm-3 col-form-label text-right">{{ __('delivery.had_receipt') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="had_receipt" id="had_receipt1" class="form-check-input @error('had_receipt') is-invalid @enderror" value="1"{{ old('had_receipt', $item->had_receipt) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="had_receipt1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="had_receipt" id="had_receipt0" class="form-check-input @error('had_receipt') is-invalid @enderror" value="0"{{ old('had_receipt', $item->had_receipt) == 0 ? ' checked' : '' }}>
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
                            <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" rows="5" placeholder="{{ __('delivery.remark') }}">{{ old('remark', $item->remark) }}</textarea>
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
