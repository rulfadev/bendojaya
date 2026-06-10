@php
    $content = method_exists($section, 'translated') ? $section->translated('content') : $section->content;
@endphp

{!! $content !!}
