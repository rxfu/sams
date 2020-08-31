@extends('layouts.app')

@section('title', __('delivery.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('delivery.module') . __('List') }}</h3>
                <div class="card-tools">
                    <a href="{{ asset('storage/files/template.xlsx') }}" title="{{ __('Download') }}" class="btn btn-warning">
                        <i class="fas fa-download"></i> {{ __('Download') . __('delivery.module') . __('template') }}
                    </a>
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
                            <input type="text" name="id" id="id" class="form-control" placeholder="学号" aria-label="学号" aria-describedby="btnSearch" value="{{ $condition['sid'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">姓名</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="姓名" aria-label="姓名" aria-describedby="btnSearch" value="{{ $condition['name'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="level">培养层次</label>
                            <select id="level" name="level" class="form-control select2">
                                <option value="all"{{ isset($condition['level']) && ('all' === $condition['level']) ? ' selected' : ''}}>全部培养层次</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item }}"{{ isset($condition['level']) && ($item === $condition['level']) ? ' selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="department">学院</label>
                            <select id="department" name="department" class="form-control select2">
                                <option value="all"{{ isset($condition['department']) && ('all' === $condition['department']) ? ' selected' : ''}}>全部学院</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}"{{ isset($condition['department']) && ($item->id === $condition['department']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="major">专业</label>
                            <select id="major" name="major" class="form-control select2">
                                <option value="all" class="all {{ $departments->implode('id', ' ') }}"{{ isset($condition['major']) && ('all' === $condition['major']) ? ' selected' : ''}}>全部专业</option>
                                @foreach ($majors as $item)
                                    <option value="{{ $item->id }}" class="{{ $item->department_id }}"{{ isset($condition['major']) && ($item->id === $condition['major']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="grade">年级</label>
                            <select id="grade" name="grade" class="form-control select2">
                                <option value="all"{{ isset($condition['grade']) && ('all' === $condition['grade']) ? ' selected' : ''}}>全部年级</option>
                                @foreach ($grades as $item)
                                    <option value="{{ $item->grade }}"{{ isset($condition['grade']) && ($item->grade === $condition['grade']) ? ' selected' : '' }}>{{ $item->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <button class="btn btn-primary" type="submit" id="search">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>

            @if (isset($items) && !empty($items))
                @if ($items->isEmpty())
                    <div class="callout callout-danger">
                        <p>查无此人</p>
                    </div>
                @else
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="text-right">
                                <p>共检索出 {{ $items->count() }} 条记录</p>
                            </div>
                        </div>
                    </div>
                    <table id="deliveries-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('delivery.id') }}</th>
                                <th>{{ __('delivery.archive_id') }}</th>
                                <th>{{ __('delivery.forward') }}</th>
                                <th>{{ __('delivery.status') }}</th>
                                <th>{{ __('delivery.receiver') }}</th>
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
                                <th>{{ __('delivery.forward') }}</th>
                                <th>{{ __('delivery.status') }}</th>
                                <th>{{ __('delivery.receiver') }}</th>
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
                    @isset($items[0])
                        @can('delete', $items[0])
                            <form id="delete-form" method="post" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        @endcan
                    @endisset
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
<script>
    $(function() {
        $('#major').chained('#department');
        $('.select2').select2();
    })
</script>
@endpush
