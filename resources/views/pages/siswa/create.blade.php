@push('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endpush

@extends('layouts.app')
@section('title', 'Create Siswa')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'siswa.create', 'method' => 'PUT', 'id' => 'form-siswa', 'enctype' => 'multipart/form-data']) !!}
            @includeIf('pages.siswa.form')
        </div>
        <div class="card-footer">
            {!! Form::button(__('Simpan'), ['class' => 'btn btn-info btn-save mt-2', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('script_vendor')
<script src="{{asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endpush

@push('script')
    <script src="{{asset('template/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    {!! Html::script('template/assets/js/asset.js') !!}
    {!! Html::script('template/assets/js/asset-siswa.js') !!}
    <script>
        $(document).ready(function() {
            Siswa.initForm();
            Siswa.initSelect();
        });
    </script>
@endpush
