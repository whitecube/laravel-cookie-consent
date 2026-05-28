<form action="{!! $url !!}" {!! $attributes !!}>
    @csrf
    <button type="submit" {!! $btnattributes !!}>
        <span class="{!! $basename !!}__label">{!! $label !!}</span>
    </button>
</form>
