@php
$message = $color = null;

if(session()->has('infobox')) {
$message = session()->get('infobox');
$color = 'info';
}

if(session()->has('errorbox')) {
$message = session()->get('errorbox');
$color = 'error';
}

if(session()->has('successbox')) {
$message = session()->get('successbox');
$color = 'success';
}
@endphp

@if($message && $color)
<div class="alert alert-{{ $color }} mb-4 w-full px-4">
    {{ $message }}
</div>
@endif
