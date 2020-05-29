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
                            <div class="form-control-plaintext">{{ $item->sid }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="card_number" class="col-sm-3 col-form-label text-right">{{ __('archive.card_number') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->student->sfzh }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('archive.name') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->student->xm }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('archive.department_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->student->xy }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="major_id" class="col-sm-3 col-form-label text-right">{{ __('archive.major_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->student->zy }}</div>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('archive.grade') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">{{ $item->student->nj }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('archive.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" id="remark" rows="5" placeholder="{{ __('archive.remark') }}">{{ old('remark') }}</textarea>
                            @error('remark')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="received_at" class="col-sm-3 col-form-label text-right">{{ __('archive.received_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker @error('received_at') is-invalid @enderror" name="received_at" id="received_at" placeholder="{{ __('archive.received_at') }}" value="{{ old('received_at') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('received_at')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    @inject('entries', 'App\Services\EntryService')
                    @foreach ($item->entries as $entry)
                        @if ($loop->index % 3 === 0)
                            <div class="row">
                        @endif

                        <div class="col-sm-4">
                            <div class="form-group row">
                                <label for="entry[{{ $entry->id }}]" class="col-sm-9 col-form-label text-right">{{ $entry->name }}</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control @error('entry.' . $entry->id) is-invalid @enderror" name="entry[{{ $entry->id }}]" id="entry[{{ $entry->id }}]" placeholder="份数" value="{{ old('entry[' . $entry->id . ']', $entry->pivot->quantity) }}" min="0">
                                    @error('entry.' . $entry->id)
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if ($loop->index % 3 === 2)
                            </div>
                        @endif
                    @endforeach
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
