@extends('layouts.app')

@section('title', __('Create') . __('archive.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('archive.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('archives.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="sid" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                        <div class="col-sm-9">
                            @inject('students', 'App\Services\StudentService')
							<select name="sid" id="sid" class="form-control select2 select2-success @error('sid') is-invalid @enderror" data-dropdown-css-class="select2-success">
                                @foreach ($students->getAllByNoArchive() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->getKey() }}（{{ $collection->xm }}）</option>
                                @endforeach
                            </select>
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
                            <div class="form-control-plaintext">
                                <span id="card_number"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('archive.name') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="name"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department" class="col-sm-3 col-form-label text-right">{{ __('archive.department_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="department"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="major" class="col-sm-3 col-form-label text-right">{{ __('archive.major_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="major"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('archive.grade') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="grade"></span>
                            </div>
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
                    @foreach ($entries->getActiveItems() as $entry)
                        @if ($loop->index % 3 === 0)
                            <div class="row">
                        @endif

                        <div class="col-sm-4">
                            <div class="form-group row">
                                <label for="entry[{{ $entry->id }}]" class="col-sm-9 col-form-label text-right">{{ $entry->name }}</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control @error('entry.' . $entry->id) is-invalid @enderror" name="entry[{{ $entry->id }}]" id="entry[{{ $entry->id }}]" placeholder="份数" value="{{ old('entry[' . $entry->id . ']', 0) }}" min="0">
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

@push('scripts')
<script>
    $(function () {
        $('#sid').change(function() {
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ url('students') }}/' + $(this).val(),
                success: function(result) {
                    if (result.message == 'success') {
                        $('#card_number').html(result.card_number);
                        $('#name').html(result.name);
                        $('#department').html(result.department);
                        $('#major').html(result.major);
                        $('#grade').html(result.grade);
                    }
                }
            })
        });

        $('#sid').trigger('change');
    })
</script>
@endpush
