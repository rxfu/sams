@extends('layouts.app')

@section('title', __('student.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('student.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('sync', Major::class)
                        <a href="{{ route('majors.sync') }}" title="{{ __('Sync') }}" class="btn btn-primary">
                            <i class="fas fa-sync"></i> {{ __('Sync') . __('major.module') }}
                        </a>
                    @endcan
                    @can('create', Major::class)
                        <a href="{{ route('majors.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('major.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <form id="search-form" name="search-form" action="{{ route('majors.search') }}" method="get">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="name">专业名称</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="专业名称" aria-label="专业名称" aria-describedby="btnSearch" value="{{ $attributes['name'] ?? '' }}">
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
                        <div class="form-group col-md-2">
                            <label for="level">培养层次</label>
                            <select id="level" name="level" class="form-control select2">
                                <option value="all"{{ isset($attributes['level']) && ('all' === $attributes['level']) ? ' selected' : ''}}>全部培养层次</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item->level }}"{{ isset($attributes['level']) && ($item->level === $attributes['level']) ? ' selected' : '' }}>{{ config('setting.level.' . $item->level) }}</option>
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
                    <table id="majors-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('major.id') }}</th>
                                <th>{{ __('major.name') }}</th>
                                <th>{{ __('major.is_enable') }}</th>
                                <th>{{ __('major.department_id') }}</th>
                                <th>{{ __('major.level') }}</th>
                                <th>{{ __('major.description') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{!! $item->present()->id !!}</td>
                                    <td>{!! $item->present()->name !!}</td>
                                    <td>{!! $item->present()->is_enable !!}</td>
                                    <td>{!! $item->present()->department_name !!}</td>
                                    <td>{!! $item->present()->level !!}</td>
                                    <td>{!! $item->present()->description !!}</td>
                                    <td>
                                        @can('view', $item)
                                            <a href="{{ route('majors.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                                <i class="fas fa-folder"></i> {{ __('Show') }}
                                            </a>
                                        @endcan
                                        @can('update', $item)
                                            <a href="{{ route('majors.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            <a href="{{ route('majors.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('major.id') }}</th>
                                <th>{{ __('major.name') }}</th>
                                <th>{{ __('major.is_enable') }}</th>
                                <th>{{ __('major.department_id') }}</th>
                                <th>{{ __('major.level') }}</th>
                                <th>{{ __('major.description') }}</th>
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
