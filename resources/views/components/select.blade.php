@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>
    @foreach($items as $item)
        <option value="{{ $item }}">{{ $item }}</option>
    @endforeach
</select>
