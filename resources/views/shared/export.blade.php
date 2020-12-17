<div>
    <form role="form" id="export-form" name="export-form" method="post" action="{{ request('action') }}">
        @csrf
        
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
                    <option value="all" class="all {{ $departments->implode('id', ' ') }}"{{ isset($attributes['major']) && ('all' === $attributes['major']) ? ' selected' : ''}}>全部专业</option>
                    @foreach ($majors as $item)
                        <option value="{{ $item->id }}" class="{{ $item->department_id }}"{{ isset($attributes['major']) && ($item->id === $attributes['major']) ? ' selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
                <label for="level">培养层次</label>
                <select id="level" name="level" class="form-control select2">
                    <option value="all"{{ isset($attributes['level']) && ('all' === $attributes['level']) ? ' selected' : ''}}>全部培养层次</option>
                    @foreach ($levels as $item)
                        <option value="{{ $item->level }}"{{ isset($attributes['level']) && ($item->level === $attributes['level']) ? ' selected' : '' }}>{{ config('setting.level.' . $item->level) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="grade">年级</label>
                <select id="grade" name="grade" class="form-control select2">
                    <option value="all"{{ isset($attributes['grade']) && ('all' === $attributes['grade']) ? ' selected' : ''}}>全部年级</option>
                    @foreach ($grades as $item)
                        <option value="{{ $item->grade }}"{{ isset($attributes['grade']) && ($item->grade === $attributes['grade']) ? ' selected' : '' }}>{{ $item->grade }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
    <script>
        $(function() {
            $('#modal_major').chained('#modal_department');
            $('.select2').select2();
        })
    </script>
</div>

