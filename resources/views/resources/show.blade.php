@isset($message)
    <div class="alert alert-success"><em>{{ $message }}</em></div>
@endisset

<h2>{{ config('app.'.$table) }} 
    @can('update', $obj)
    <a href="{{ route($prefix.'.edit', $obj) }}" class="btn btn-warning">Edit</a>
    @endcan
    @can('create', $modal)
    <a href="{{ route($prefix.'.create') }}" class="btn btn-primary float-right">Create New {{ config('app.'.$table) }}</a>
    @endcan
</h2>

<div class="table-responsive-sm">
    <table class="table table-borderless">
        <tbody>
            {{ $tbody }}
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
