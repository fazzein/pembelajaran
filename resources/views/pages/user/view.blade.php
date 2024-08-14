@extends('layouts.app')
@section('title', 'User View')
@section('breadcrumb')
    @parent
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Form View User</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                {!! Form::label('', 'Nama', []) !!}
                {!! Form::text('', $model->name, ['class' => 'form-control','readonly']) !!}
            </div>
            <div class="col-lg-4">
                {!! Form::label('', 'Email', []) !!}
                {!! Form::text('', $model->email, ['class' => 'form-control','readonly']) !!}
            </div>
            <div class="col-lg-4">
                {!! Form::label('', 'Role', []) !!}
                {!! Form::text('', $model->role_name, ['class' => 'form-control','readonly']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['user.delete', $model->id],
            'style' => 'display:inline',
            'onsubmit' => 'return confirm("Apakah Anda yakin ingin menghapus data ini?");'
        ]) !!}
            {!! Form::button(__('Delete'), ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div> 
@endsection
