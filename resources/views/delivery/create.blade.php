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
                        <label for="student" class="col-sm-3 col-form-label text-right">{{ __('archive.sid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="student" id="student" class="form-control @error('student') is-invalid @enderror" placeholder="{{ __('archive.sid') }}" value="{{ old('student') }}" data-provide="typeahead" onfocus="this.select()" autocomplete="off" autofocus required>
                            @error('student')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="archive" class="col-sm-3 col-form-label text-right">{{ __('delivery.archive_id') }}</label>
                        <div class="col-sm-9">
                            <div class="form-control-plaintext">
                                <span id="archive"></span>
                            </div>
                            <input type="hidden" name="archive_id" id="archive_id">
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
                    url: "{{ route('archives.list') }}",
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
                                grade: item.grade,
                                aid: item.aid
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

                $('#archive_id').attr('value', item.aid);
                $('#archive').text(item.aid);
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
