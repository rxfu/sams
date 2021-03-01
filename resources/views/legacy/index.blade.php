@extends('layouts.app')

@section('title', __('history.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('history.module') . __('List') }}</h3>
            </div>

            <div class="card-body">
                <form id="search-form" name="search-form" action="{{ route('archives.search') }}" method="get">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="id">学号</label>
                            <input type="text" name="id" id="id" class="form-control" placeholder="学号" aria-label="学号" aria-describedby="btnSearch" value="{{ $attributes['sid'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">姓名</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="姓名" aria-label="姓名" aria-describedby="btnSearch" value="{{ $attributes['name'] ?? '' }}">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-2">
                            <label for="grade">年级</label>
                            <select id="grade" name="grade" class="form-control select2">
                                <option value="all"{{ isset($attributes['grade']) && ('all' === $attributes['grade']) ? ' selected' : ''}}>全部年级</option>
                                @foreach ($grades as $item)
                                    <option value="{{ $item->grade }}"{{ isset($attributes['grade']) && ($item->grade === $attributes['grade']) ? ' selected' : '' }}>{{ $item->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="level">培养层次</label>
                            <select id="level" name="level" class="form-control select2">
                                <option value="all"{{ isset($attributes['level']) && ('all' === $attributes['level']) ? ' selected' : ''}}>全部培养层次</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item->id }}"{{ isset($attributes['level']) && ($item->id === $attributes['level']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="department">学院</label>
                            <select id="department" name="department" class="form-control select2">
                                <option value="all"{{ isset($attributes['department']) && ('all' === $attributes['department']) ? ' selected' : ''}}>全部学院</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}"{{ isset($attributes['department']) && ($item->id === $attributes['department']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="major">专业</label>
                            <select id="major" name="major" class="form-control select2">
                                <option value="all" data-chained="all {{ $departments->implode('id', ' ') }} {{ $levels->implode('id', ' ') }}"{{ isset($attributes['major']) && ('all' === $attributes['major']) ? ' selected' : ''}}>全部专业</option>
                                @foreach ($majors as $item)
                                    <option value="{{ $item->id }}" data-chained="{{ $item->level }}+{{ $item->department_id }}"{{ isset($attributes['major']) && ($item->id === $attributes['major']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <button class="btn btn-primary" type="submit" id="search">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
            
            @isset($items)
                @if ($items->isEmpty())
                    <div class="callout callout-danger">
                        <p>没有搜索到符合条件的档案记录，请重新输入检索条件</p>
                    </div>
                @else
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="text-right">
                                <p>共检索出 {{ $items->total() }} 条记录</p>
                            </div>
                        </div>
                    </div>
                    <table id="histories-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('history.id') }}</th>
                                <th>{{ __('history.name') }}</th>
                                <th>{{ __('history.idtype') }}</th>
                                <th>{{ __('history.idnumber') }}</th>
                                <th>{{ __('history.gender') }}</th>
                                <th>{{ __('history.nation') }}</th>
                                <th>{{ __('history.department') }}</th>
                                <th>{{ __('history.major') }}</th>
                                <th>{{ __('history.grade') }}</th>
                                <th>{{ __('history.duration') }}</th>
                                <th>{{ __('history.level') }}</th>
                                <th>{{ __('history.archive_id') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->idtype }}</td>
                                    <td>{{ $item->idnumber }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->nation }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->major }}</td>
                                    <td>{{ $item->grade }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>{{ $item->archive_id}}</td>
                                    <td>
                                        @can('delete', $item)
                                            <a href="{{ route('archived.destroy', $item) }}" class="btn btn-danger btn-sm unarchive" title="{{ __('Unarchive') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Unarchive') }}">
                                                <i class="fas fa-trash-restore"></i> {{ __('Unarchive') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('history.id') }}</th>
                                <th>{{ __('history.name') }}</th>
                                <th>{{ __('history.idtype') }}</th>
                                <th>{{ __('history.idnumber') }}</th>
                                <th>{{ __('history.gender') }}</th>
                                <th>{{ __('history.nation') }}</th>
                                <th>{{ __('history.department') }}</th>
                                <th>{{ __('history.major') }}</th>
                                <th>{{ __('history.grade') }}</th>
                                <th>{{ __('history.duration') }}</th>
                                <th>{{ __('history.level') }}</th>
                                <th>{{ __('history.archive_id') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{ $items->withQueryString()->links() }}
                    @isset($items[0])
                        @can('delete', $items[0])
                            <form id="delete-form" method="post" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        @endcan
                    @endisset
                @endif
            @endisset
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
<script>
    $(function() {
        $('#major').chained('#level, #department');
        $('.select2').select2();
    })
</script>
@endpush
