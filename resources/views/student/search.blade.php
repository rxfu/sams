@extends('layouts.app')

@section('title', __('student.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('student.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('sync', Student::class)
                        <a href="{{ route('students.sync') }}" title="{{ __('Sync') }}" class="btn btn-primary">
                            <i class="fas fa-sync"></i> {{ __('Sync') . __('student.module') }}
                        </a>
                    @endcan
                    @can('create', Student::class)
                        <a href="{{ route('students.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('student.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <form id="search-form" name="search-form" action="{{ route('students.search') }}" method="get">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="id">学号</label>
                            <input type="text" name="id" id="id" class="form-control" placeholder="学号" aria-label="学号" aria-describedby="btnSearch" value="{{ $attributes['id'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">姓名</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="姓名" aria-label="姓名" aria-describedby="btnSearch" value="{{ $attributes['name'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="level">培养层次</label>
                            <select id="level" name="level" class="form-control select2">
                                <option value="all"{{ isset($attributes['level']) && ('all' === $attributes['level']) ? ' selected' : ''}}>全部培养层次</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item }}"{{ isset($attributes['level']) && ($item === $attributes['level']) ? ' selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
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
                                <option value="all" class="all {{ $departments->implode('id', ' ') }}"{{ isset($attributes['major']) && ('all' === $attributes['major']) ? ' selected' : ''}}>全部专业</option>
                                @foreach ($majors as $item)
                                    <option value="{{ $item->id }}" class="{{ $item->department_id }}"{{ isset($attributes['major']) && ($item->id === $attributes['major']) ? ' selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="grade">年级</label>
                            <select id="grade" name="grade" class="form-control select2">
                                <option value="all"{{ isset($attributes['grade']) && ('all' === $attributes['grade']) ? ' selected' : ''}}>全部年级</option>
                                @foreach ($grades as $item)
                                    <option value="{{ $item->grade }}"{{ isset($attributes['grade']) && ($item->grade === $attributes['grade']) ? ' selected' : '' }}>{{ $item->grade }}</option>
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
                                <th>{{ __('student.id') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.idtype') }}</th>
                                <th>{{ __('student.idnumber') }}</th>
                                <th>{{ __('student.gender_id') }}</th>
                                <th>{{ __('student.nation_id') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('student.duration') }}</th>
                                <th>{{ __('student.status') }}</th>
                                <th>{{ __('student.level') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{!! $item->present()->id !!}</td>
                                    <td>{!! $item->present()->name !!}</td>
                                    <td>{!! $item->present()->idtype !!}</td>
                                    <td>{!! $item->present()->idnumber !!}</td>
                                    <td>{!! $item->present()->gender !!}</td>
                                    <td>{!! $item->present()->nation !!}</td>
                                    <td>{!! $item->present()->department !!}</td>
                                    <td>{!! $item->present()->major !!}</td>
                                    <td>{!! $item->present()->grade !!}</td>
                                    <td>{!! $item->present()->duration !!}</td>
                                    <td>{!! $item->present()->status !!}</td>
                                    <td>{!! $item->present()->level !!}</td>
                                    <td>
                                        @can('view', $item)
                                            <a href="{{ route('students.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                                <i class="fas fa-folder"></i> {{ __('Show') }}
                                            </a>
                                        @endcan
                                        @can('update', $item)
                                            <a href="{{ route('students.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            <a href="{{ route('students.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('student.id') }}</th>
                                <th>{{ __('student.name') }}</th>
                                <th>{{ __('student.idtype') }}</th>
                                <th>{{ __('student.idnumber') }}</th>
                                <th>{{ __('student.gender_id') }}</th>
                                <th>{{ __('student.nation_id') }}</th>
                                <th>{{ __('student.department_id') }}</th>
                                <th>{{ __('student.major_id') }}</th>
                                <th>{{ __('student.grade') }}</th>
                                <th>{{ __('student.duration') }}</th>
                                <th>{{ __('student.status') }}</th>
                                <th>{{ __('student.level') }}</th>
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
            @endisset
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
