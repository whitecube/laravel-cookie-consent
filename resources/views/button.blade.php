<form action="{!! $url !!}" {!! $attributes !!}>
    @csrf
    <button type="submit" class="{!! $basename !!}__link">
        <span class="{!! $basename !!}__label">{{ $label }}</span>
    </button>
</form>
