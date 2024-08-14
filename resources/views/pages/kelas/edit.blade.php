@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@extends('layouts.app')
@section('title', 'Edit Kelas')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($model, [
                'method' => 'PATCH',
                'route' => ['kelas.edit', $model->id],
                'id' => 'form-save',
            ]) !!}
            @includeIf('pages.kelas.form')
            {!! Form::button(__('Simpan'), ['class' => 'btn btn-info mt-2', 'type' => 'submit']) !!}
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
