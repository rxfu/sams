@extends('layouts.app')

@section('title', __('idtype.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('idtype.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('sync', Idtype::class)
                        <a href="{{ route('idtypes.sync') }}" title="{{ __('Sync') }}" class="btn btn-primary">
                            <i class="fas fa-sync"></i> {{ __('Sync') . __('idtype.module') }}
                        </a>
                    @endcan
                    @can('create', Idtype::class)
                        <a href="{{ route('idtypes.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('idtype.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="idtypes-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('idtype.id') }}</th>
							<th>{{ __('idtype.name') }}</th>
							<th>{{ __('idtype.is_enable') }}</th>
							<th>{{ __('idtype.description') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
								<td>{!! $item->present()->id !!}</td>
								<td>{!! $item->present()->name !!}</td>
								<td>{!! $item->present()->is_enable !!}</td>
                                <td>{!! $item->present()->description !!}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('idtypes.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('idtypes.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('idtypes.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('idtype.id') }}</th>
							<th>{{ __('idtype.name') }}</th>
							<th>{{ __('idtype.is_enable') }}</th>
							<th>{{ __('idtype.description') }}</th>
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
	$('#idtypes-table').DataTable({
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
