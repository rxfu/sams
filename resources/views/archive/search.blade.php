@extends('layouts.app')

@section('title', __('archive.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('archive.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('export', Archive::class)
                        <a href="{{ route('archives.export') }}" title="{{ __('Export') }}" class="btn btn-secondary">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('archive.module') }}
                        </a>
                    @endcan
                    @can('import', Archive::class)
                        <a href="{{ route('archives.import') }}" title="{{ __('Import') }}" class="btn btn-info import" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('archive.module') . __('import') }}
                        ">
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
                <form id="search-form" name="search-form" action="{{ route('archives.search') }}" method="post">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="id">学号</label>
                            <input type="text" name="id" id="id" class="form-control" placeholder="学号" aria-label="学号" aria-describedby="btnSearch" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">姓名</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="姓名" aria-label="姓名" aria-describedby="btnSearch" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="level">培养层次</label>
                            <select id="level" name="level" class="form-control">
                                <option value="all">全部培养层次</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="department">学院</label>
                            <select id="department" name="department" class="form-control">
                                <option value="all">全部学院</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="major">专业</label>
                            <select id="major" name="major" class="form-control">
                                <option value="all" class="all {{ $departments->implode('id', ' ') }}">全部专业</option>
                                @foreach ($majors as $item)
                                    <option value="{{ $item->id }}" class="{{ $item->department_id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="grade">年级</label>
                            <select id="grade" name="grade" class="form-control">
                                <option value="all">全部年级</option>
                                @foreach ($grades as $item)
                                    <option value="{{ $item->grade }}">{{ $item->grade }}</option>
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
                <table id="archives-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('archive.id') }}</th>
                            <th>{{ __('archive.sid') }}</th>
                            <th>{{ __('archive.card_number') }}</th>
                            <th>{{ __('archive.received_at') }}</th>
                            <th>{{ __('archive.name') }}</th>
                            <th>{{ __('archive.department_id') }}</th>
                            <th>{{ __('archive.major_id') }}</th>
                            <th>{{ __('archive.grade') }}</th>
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
                                <td>{{ $item->student->card_number }}</td>
                                <td>{{ $item->received_at }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->student->department }}</td>
                                <td>{{ $item->student->major }}</td>
                                <td>{{ $item->student->grade }}</td>
                                <td>{{ optional($item->creator)->name }}</td>
                                <td>{{ optional($item->editor)->name }}</td>
                                <td>{{ $item->remark }}</td>
                                <td>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('archive.id') }}</th>
                            <th>{{ __('archive.sid') }}</th>
                            <th>{{ __('archive.card_number') }}</th>
                            <th>{{ __('archive.received_at') }}</th>
                            <th>{{ __('archive.name') }}</th>
                            <th>{{ __('archive.department_id') }}</th>
                            <th>{{ __('archive.major_id') }}</th>
                            <th>{{ __('archive.grade') }}</th>
                            <th>{{ __('archive.creator_id') }}</th>
                            <th>{{ __('archive.editor_id') }}</th>
                            <th>{{ __('archive.remark') }}</th>
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/jquery-chained/jquery.chained.min.js') }}"></script>
    <script>
        $(function() {
            $('#major').chained('#department');
        })
    </script>
@endpush
