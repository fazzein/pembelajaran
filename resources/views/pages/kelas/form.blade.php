<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('nama_kelas', 'Nama Kelas') !!}
            {!! Form::text('nama_kelas', null, ['class' => 'form-control', ]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('status_id', 'Status') !!}
            {!! Form::select('status_id', $status, $model->status_id ?? '', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

