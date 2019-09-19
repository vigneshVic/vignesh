<div class="panel panel-default">
    <div class="panel-heading"><b>{{ config('app.'.$table) }}</b></div>
    <div class="panel-body">

        @if(isset($obj))
        <form 
            class="form-horizontal" 
            method="POST" 
            action="{{ route($prefix.'.update', $obj) }}"
        >
            {{ method_field('PATCH') }}
        @else
        <form 
            class="form-horizontal" 
            method="POST" 
            action="{{ route($prefix.'.store') }}"
        >
        @endif
        
            {{ csrf_field() }}

            {{ $body }}

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            
        </form>

        @if(isset($obj))
        @can('delete', $obj)
            <form 
                class="form-horizontal" 
                method="POST" 
                action="{{ route($prefix.'.destroy', $obj) }}" 
                style="margin-top: 10px;" 
                onsubmit="return confirm('Do you really want to Delete it?');"
            >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        @endcan
        @endif

        @include('include.errors')
    </div>
</div>
