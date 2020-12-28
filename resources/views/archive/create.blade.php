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
                        <label for="student" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="student" id="student" class="form-control @error('student') is-invalid @enderror" placeholder="{{ __('student.id') }}" value="{{ old('student') }}" data-provide="typeahead" onfocus="this.select()" autocomplete="off" autofocus required>
                            @error('student')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <input type="hidden" name="sid" id="sid">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idnumber" class="col-sm-3 col-form-label text-right">{{ __('student.idnumber') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="idnumber"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('student.name') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="name"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department" class="col-sm-3 col-form-label text-right">{{ __('student.department_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="department"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="major" class="col-sm-3 col-form-label text-right">{{ __('student.major_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="major"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label text-right">{{ __('student.grade') }}</label>
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
<script src="{{ asset('plugins/bootstrap-typeahead/bootstrap-typeahead.js') }}"></script>
<script>
    $(function () {
        $('#student').typeahead({
            menu: '<ul class="typeahead dropdown-menu"></ul>',
            item: '<li><a class="dropdown-item" href="#"></a></li>',
            items: 5,

            source: function(query, process) {
                var parameter = { q: query };

                $.ajax({
                    url: "{{ route('students.list') }}",
                    type: 'get',
                    data: {
                        q: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        var results = data.map(function(item) {
                            var student = {
                                id: item.id,
                                name: item.name,
                                idnumber: item.idnumber,
                                department: item.department,
                                major: item.major,
                                grade: item.grade
                            };

                            return JSON.stringify(student);
                        });
                        
                        process(results);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                })
            },

            highlighter: function(obj) {
                var item = JSON.parse(obj);

                var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
                return item.id.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                    return '<strong>' + match + '</strong>';
                }) + '(' + item.name + ')';
            },

            updater: function(obj) {
                var item = JSON.parse(obj);

                $('#sid').attr('value', item.id);
                $('#idnumber').text(item.idnumber);
                $('#name').text(item.name);
                $('#department').text(item.department);
                $('#major').text(item.major);
                $('#grade').text(item.grade);

                return item.id;
            }
        })
    })
</script>
@endpush
