@php
    $scaffolding = app('scaffolding');
    $prefix = $scaffolding->prefix();
    $title = $scaffolding->title();
@endphp
@if(\Route::getRoutes()->hasNamedRoute("{$prefix}.create"))
    <a href="{{$href ?? route("{$prefix}.create")}}" class="btn btn-success mb-2 {{isset($modal) ? 'modal-trigger' : ''}}">
     Add {{\Str::title($title ?? $prefix)}}
    </a>
@endif
@include('scaffolding::index-toolbar-search')

