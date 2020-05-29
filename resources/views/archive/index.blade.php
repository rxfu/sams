@extends('layouts.app')

@section('title', __('archive.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('archive.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Archive::class)
                        <a href="{{ route('archives.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('archive.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
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
								<td>{{ $item->student->sfzh }}</td>
								<td>{{ $item->received_at }}</td>
								<td>{{ $item->student->xm }}</td>
								<td>{{ $item->student->xy }}</td>
								<td>{{ $item->student->zy }}</td>
								<td>{{ $item->student->nj }}</td>
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
	$('#archives-table').DataTable({
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
