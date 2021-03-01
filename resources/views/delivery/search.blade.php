@extends('layouts.app')

@section('title', __('delivery.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('delivery.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('notice', Delivery::class)
                        <a href="{{ route('deliveries.export-notice') }}" title="{{ __('Export') }}" class="btn btn-primary export" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('delivery.module') }}通知单{{ __('export') }}
                        ">
                            <i class="fas fa-flag-checkered"></i> {{ __('Export') . __('delivery.module') }}通知单
                        </a>
                    @endcan
                    @can('ems', Delivery::class)
                        <a href="{{ route('deliveries.export-ems') }}" title="{{ __('Export') }}" class="btn btn-secondary export" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('delivery.module') }}机要交寄单{{ __('export') }}
                        ">
                            <i class="fas fa-mail-bulk"></i> {{ __('Export') . __('delivery.module') }}机要交寄单
                        </a>
                    @endcan
                    @can('download', Delivery::class)
                        <a href="{{ asset('storage/files/template.xlsx') }}" title="{{ __('Download') }}" class="btn btn-warning">
                            <i class="fas fa-download"></i> {{ __('Download') . __('delivery.module') . __('template') }}
                        </a>
                    @endcan
                    @can('import', Delivery::class)
                        <a href="{{ route('deliveries.import') }}" title="{{ __('Import') }}" class="btn btn-info import" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('delivery.module') . __('import') }}
                    ">
                            <i class="fas fa-file-import"></i> {{ __('Import') . __('delivery.module') }}
                        </a>
                    @endcan
                    @can('create', Delivery::class)
                        <a href="{{ route('deliveries.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('delivery.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <form id="search-form" name="search-form" action="{{ route('deliveries.search') }}" method="get">
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
                        <p>没有搜索到符合条件的档案去向记录，请重新输入检索条件</p>
                    </div>
                @else
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="text-right">
                                <p>共检索出 {{ $items->total() }} 条记录</p>
                            </div>
                        </div>
                    </div>
                    <table id="deliveries-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('delivery.id') }}</th>
                                <th>{{ __('delivery.archive_id') }}</th>
                                <th>{{ __('archive.sid') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('delivery.forward') }}</th>
                                <th>{{ __('delivery.status') }}</th>
                                <th>{{ __('delivery.ems') }}</th>
                                <th>{{ __('delivery.phone') }}</th>
                                <th>{{ __('delivery.address') }}</th>
                                <th>{{ __('delivery.had_receipt') }}</th>
                                <th>{{ __('delivery.creator_id') }}</th>
                                <th>{{ __('delivery.editor_id') }}</th>
                                <th>{{ __('delivery.version') }}</th>
                                <th>{{ __('delivery.remark') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->archive_id }}</td>
                                    <td>{{ $item->archive->sid }}</td>
                                    <td>{{ $item->archive->student->name }}</td>
                                    <td>{{ $item->archive->student->department->name }}</td>
                                    <td>{{ $item->archive->student->major->name }}</td>
                                    <td>{{ $item->archive->student->grade }}</td>
                                    <td>{{ $item->forward }}</td>
                                    <td>{{ $item->present()->hasStatus }}</td>
                                    <td>{{ $item->receiver }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->present()->hadReceipt }}</td>
                                    <td>{{ optional($item->creator)->name }}</td>
                                    <td>{{ optional($item->editor)->name }}</td>
                                    <td>{{ $item->version }}</td>
                                    <td>{{ $item->remark }}</td>
                                    <td>
                                        @can('view', $item)
                                            <a href="{{ route('deliveries.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                                <i class="fas fa-folder"></i> {{ __('Show') }}
                                            </a>
                                        @endcan
                                        @can('update', $item)
                                            <a href="{{ route('deliveries.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            <a href="{{ route('deliveries.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('delivery.id') }}</th>
                                <th>{{ __('delivery.archive_id') }}</th>
                                <th>{{ __('archive.sid') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('delivery.forward') }}</th>
                                <th>{{ __('delivery.status') }}</th>
                                <th>{{ __('delivery.ems') }}</th>
                                <th>{{ __('delivery.phone') }}</th>
                                <th>{{ __('delivery.address') }}</th>
                                <th>{{ __('delivery.had_receipt') }}</th>
                                <th>{{ __('delivery.creator_id') }}</th>
                                <th>{{ __('delivery.editor_id') }}</th>
                                <th>{{ __('delivery.version') }}</th>
                                <th>{{ __('delivery.remark') }}</th>
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
