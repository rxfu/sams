<div>
    <form role="form" id="export-form" name="export-form" method="post" action="{{ request('action') }}">
        @csrf
        
        <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
                <label for="modal_grade">年级</label>
                <select id="modal_grade" name="grade" class="form-control select2">
                    <option value="all"{{ isset($attributes['grade']) && ('all' === $attributes['grade']) ? ' selected' : ''}}>全部年级</option>
                    @foreach ($grades as $item)
                        <option value="{{ $item->grade }}"{{ isset($attributes['grade']) && ($item->grade === $attributes['grade']) ? ' selected' : '' }}>{{ $item->grade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="modal_level">培养层次</label>
                <select id="modal_level" name="level" class="form-control select2">
                    <option value="all"{{ isset($attributes['level']) && ('all' === $attributes['level']) ? ' selected' : ''}}>全部培养层次</option>
                    @foreach ($levels as $item)
                        <option value="{{ $item->id }}"{{ isset($attributes['level']) && ($item->id === $attributes['level']) ? ' selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
                <label for="modal_department">学院</label>
                <select id="modal_department" name="department" class="form-control select2">
                    <option value="all"{{ isset($attributes['department']) && ('all' === $attributes['department']) ? ' selected' : ''}}>全部学院</option>
                    @foreach ($departments as $item)
                        <option value="{{ $item->id }}"{{ isset($attributes['department']) && ($item->id === $attributes['department']) ? ' selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="modal_major">专业</label>
                <select id="modal_major" name="major" class="form-control select2">
                    <option value="all" data-chained="all {{ $departments->implode('id', ' ') }} {{ $levels->implode('id', ' ') }}"{{ isset($attributes['major']) && ('all' === $attributes['major']) ? ' selected' : ''}}>全部专业</option>
                    @foreach ($majors as $item)
                        <option value="{{ $item->id }}" data-chained="{{ $item->level }}+{{ $item->department_id }}"{{ isset($attributes['major']) && ($item->id === $attributes['major']) ? ' selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-12">
                <label for="send_at">{{ __('delivery.send_at') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker @error('send_at') is-invalid @enderror" name="send_at" id="send_at" placeholder="{{ __('delivery.send_at') }}" value="{{ old('send_at') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
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
    </form>

    <script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
    <script>
        $(function() {
            $('#modal_major').chained('#modal_level, #modal_department');
            $('.select2').select2();

            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: "YYYY-MM-DD",
                    applyLabel: '确定',
                    cancelLabel: '取消',
                    daysOfWeek: [
                        '日',
                        '一',
                        '二',
                        '三',
                        '四',
                        '五',
                        '六'
                    ],
                    monthNames: [
                        '一月',
                        '二月',
                        '三月',
                        '四月',
                        '五月',
                        '六月',
                        '七月',
                        '八月',
                        '九月',
                        '十月',
                        '十一月',
                        '十二月'
                    ],
                    firstDay: 1
                }
            });
        });
    </script>
</div>

