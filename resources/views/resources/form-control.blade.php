<div class="form-group {{ isset($column) ? $errors->has($column) ? 'has-error' : '' : '' }}">
    @isset($title)
        <label class="col-md-4 control-label">{{ $title }}</label>
    @endisset

    @isset($slot)
        <div class="col-md-6">
            {{ $slot }}

            @isset($column)
                @if ($errors->has($column))
                    <span class="help-block">
                        <strong>{{ $errors->first($column) }}</strong>
                    </span>
                @endif
            @endisset
        </div>
    @endisset
</div>