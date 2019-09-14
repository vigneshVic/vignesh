@isset($message)
    <div class="alert alert-success"><em>{{ $message }}</em></div>
@endisset

<h2><i class="fa fa-users"></i>{{ config('app.'.$table) }} 
	@can('create', $modal)
	    <a href="{{ route($prefix.'.create') }}" class="btn btn-primary float-right">Create New {{ config('app.'.$table) }}</a>
	@endcan
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right mr-1">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right mr-1">Permissions</a>
</h2>
<hr>

@isset($filter)
<div class="d-flex flex-wrap align-content-around bg-light" style="height:auto;">
    <form 
        class="form-inline" 
        method="GET" 
        action="{{ route($prefix.'.index') }}"
    >
        {!! $filter !!}
        <div class='p-2'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endisset

@if($obj->count())
    <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
            <tr>
                {{ $thead }}
            </tr>
        </thead>
        <tbody>
            {{ $tbody }}
            <tfoot>
                <tr>
                    <td colspan="7" class="text-center">{!! $obj->links() !!}</td>
                </tr>
            </tfoot>
        </tbody>
    </table>
@else
    <div class="jumbotron text-center">No Records Found!</div>
@endif