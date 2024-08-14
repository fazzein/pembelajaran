@extends('layouts.app')
@section('title', 'Edit Siswa')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($model, [
                'method' => 'PATCH',
                'route' => ['siswa.edit', $model->id],
                'id' => 'form-siswa',
            ]) !!}
            @includeIf('pages.siswa.form')
            {!! Form::button(__('Simpan'), ['class' => 'btn btn-info mt-2', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('script')
    {!! Html::script('template/assets/js/asset.js') !!}
    {!! Html::script('template/assets/js/asset-siswa.js') !!}
    <script>
        $(document).ready(function() {
            Siswa.initForm();
            Siswa.initSelect();
        });
    </script>
@endpush
