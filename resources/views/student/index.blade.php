@extends('layouts.app')

@section('title', __('student.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('student.module') . __('List') }}</h3>
                <div class="card-tools">
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
							<th>{{ __('student.card_type') }}</th>
							<th>{{ __('student.card_id') }}</th>
							<th>{{ __('student.gender') }}</th>
							<th>{{ __('student.nation') }}</th>
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
                                <td>{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->card_type }}</td>
								<td>{{ optional($item->card)->name }}</td>
								<td>{{ $item->gender }}</td>
								<td>{{ $item->nation }}</td>
								<td>{{ optional($item->department)->name }}</td>
								<td>{{ optional($item->major)->name }}</td>
								<td>{{ $item->grade }}</td>
								<td>{{ $item->duration }}</td>
								<td>{{ $item->status }}</td>
								<td>{{ $item->level }}</td>
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
							<th>{{ __('student.card_type') }}</th>
							<th>{{ __('student.card_id') }}</th>
							<th>{{ __('student.gender') }}</th>
							<th>{{ __('student.nation') }}</th>
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
