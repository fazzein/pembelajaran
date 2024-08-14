@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush

@extends('layouts.app')
@section('title', 'Create Kelas')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open([
                'route' => 'kelas.create',
                'method' => 'PUT',
                'id' => 'form-save',
                'enctype' => 'multipart/form-data',
            ]) !!}
            @includeIf('pages.kelas.form')
        </div>
        <div class="card-footer">
            {!! Form::button(__('Simpan'), ['class' => 'btn btn-info btn-save mt-2', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('script_vendor')
    <script src="{{ asset('template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('script')
    <script src="{{ asset('template/app-assets/js/scripts/forms/form-select2.js') }}"></script>
    {!! Html::script('template/assets/js/asset.js') !!}
    {!! Html::script('template/assets/js/asset-save.js') !!}
    <script>
        $(document).ready(function() {
            Save.initForm();
            Save.initSelect();
        });
    </script>
@endpush
