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
                <table id="deliveries-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('delivery.id') }}</th>
							<th>{{ __('delivery.archive_id') }}</th>
							<th>{{ __('delivery.receiver') }}</th>
							<th>{{ __('delivery.phone') }}</th>
							<th>{{ __('delivery.employment') }}</th>
							<th>{{ __('delivery.ems') }}</th>
							<th>{{ __('delivery.status') }}</th>
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
								<td>{{ $item->receiver }}</td>
								<td>{{ $item->phone }}</td>
								<td>{{ $item->employment }}</td>
								<td>{{ $item->ems }}</td>
								<td>{{ $item->present()->hasStatus }}</td>
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
							<th>{{ __('delivery.receiver') }}</th>
							<th>{{ __('delivery.phone') }}</th>
							<th>{{ __('delivery.employment') }}</th>
							<th>{{ __('delivery.ems') }}</th>
							<th>{{ __('delivery.status') }}</th>
							<th>{{ __('delivery.had_receipt') }}</th>
							<th>{{ __('delivery.creator_id') }}</th>
							<th>{{ __('delivery.editor_id') }}</th>
							<th>{{ __('delivery.version') }}</th>
							<th>{{ __('delivery.remark') }}</th>
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
	$('#deliveries-table').DataTable({
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
