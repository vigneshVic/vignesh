<div class="d-flex flex-row justify-content-around">
    @can('view', $obj)
    <a href="{{ route($prefix.'.show', $obj) }}"><i class="material-icons">&#xe8f4;</i></a>
    @endcan
    @can('update', $obj)
    <a href="{{ route($prefix.'.edit', $obj) }}"><i class='fas' style="font-size: 22px;">&#xf044;</i></a>
    @endcan
    @can('delete', $obj)
    <form method="POST" action="{{ route($prefix.'.destroy', $obj) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a href="#" onclick="this.closest('form').submit();">
            <i class="material-icons" style="color:red;">&#xe872;</i>
        </a>
    </form>
    @endcan
</div>
<!-- <i class="material-icons">&#xe3c9;</i> -->
<!-- <i style="font-size: 30px;" class='far'>&#xf044;</i> -->