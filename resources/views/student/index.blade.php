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
                <table id="students-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('student.id') }}</th>
							<th>{{ __('student.name') }}</th>
							<th>{{ __('student.idtype_id') }}</th>
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
            </div>
            @isset($items[0])
                @can('delete', $items[0])
                    <form id="delete-form" method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                @endcan
            @endisset
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
	$('#students-table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('plugins/datatables/lang/Chinese.json') }}"
        }
    });
</script>
@endpush
