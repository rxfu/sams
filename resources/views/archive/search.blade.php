@extends('layouts.app')

@section('title', __('archive.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('archive.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', History::class)
                        <a href="{{ route('archived.create') }}" title="{{ __('Archive') }}" class="btn btn-warning archive" data-toggle="modal" data-target="#dialog" data-whatever="批量{{ __('Archive') }}">
                            <i class="fas fa-archive"></i> 批量{{ __('Archive') }}
                        </a>
                    @endcan
                    @can('export', Archive::class)
                        <a href="{{ route('archives.export') }}" title="{{ __('Export') }}" class="btn btn-secondary export" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('archive.module') }}移交表m欧版{{ __('export') }}">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('archive.module') }}移交表模板
                        </a>
                    @endcan
                    @can('transfer', Archive::class)
                        <a href="{{ route('archives.export-transfer') }}" title="{{ __('Export') }}" class="btn btn-primary export" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('archive.module') }}移交表{{ __('export') }}">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('archive.module') }}移交表
                        </a>
                    @endcan
                    @can('import', Archive::class)
                        <a href="{{ route('archives.import') }}" title="{{ __('Import') }}" class="btn btn-info import" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('archive.module') . __('import') }}">
                            <i class="fas fa-file-import"></i> {{ __('Import') . __('archive.module') }}
                        </a>
                    @endcan
                    @can('create', Archive::class)
                        <a href="{{ route('archives.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('archive.module') }}
                        </a>
                    @endcan
                </div>
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
                    <table id="archives-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('archive.id') }}</th>
                                <th>{{ __('archive.sid') }}</th>
                                <th>{{ __('student.idnumber') }}</th>
                                <th>{{ __('archive.received_at') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('archive.creator_id') }}</th>
                                <th>{{ __('archive.editor_id') }}</th>
                                <th>{{ __('archive.remark') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->sid }}</td>
                                    <td>{{ $item->student->idnumber }}</td>
                                    <td>{{ $item->received_at }}</td>
                                    <td>{{ $item->student->name }}</td>
                                    <td>{{ $item->student->department->name }}</td>
                                    <td>{{ $item->student->major->name }}</td>
                                    <td>{{ $item->student->grade }}</td>
                                    <td>{{ $item->creator->name }}</td>
                                    <td>{{ $item->editor->name }}</td>
                                    <td>{{ $item->remark }}</td>
                                    <td>
                                        @if ($item->is_archived)
                                            数据已归档
                                        @else
                                            @can('create', History::class)
                                                <a href="{{ route('archived.create') }}" title="{{ __('Archive') }}" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Archive') }}" data-archive-id="{{ $item->id }}">
                                                    <i class="fas fa-archive"></i> {{ __('Archive') }}
                                                </a>
                                                <form id="archive-form-{{ $item->id }}" method="post" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="archive_id" value="{{ $item->id }}">
                                                </form>
                                            @endcan
                                            @can('view', $item)
                                                <a href="{{ route('archives.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                                    <i class="fas fa-folder"></i> {{ __('Show') }}
                                                </a>
                                            @endcan
                                            @can('update', $item)
                                                <a href="{{ route('archives.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                                </a>
                                            @endcan
                                            @can('delete', $item)
                                                <a href="{{ route('archives.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                </a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('archive.id') }}</th>
                                <th>{{ __('archive.sid') }}</th>
                                <th>{{ __('student.idnumber') }}</th>
                                <th>{{ __('archive.received_at') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('archive.creator_id') }}</th>
                                <th>{{ __('archive.editor_id') }}</th>
                                <th>{{ __('archive.remark') }}</th>
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
