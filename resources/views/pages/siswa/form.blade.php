<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('nama', 'Nama') !!}
            {!! Form::text('nama_siswa', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('nis', 'NIS') !!}
            {!! Form::text('nis', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('tempat_lahir', 'Tempat Lahir') !!}
            {!! Form::text('tempat_lahir', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('tanggal_lahir', 'Tanggal Lahir') !!}
            {!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('jenis_kelamin', 'Jenis Kelamin') !!}
            {!! Form::select('jenis_kelamin', ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('telepon', 'Nomor Telepon') !!}
            {!! Form::text('telepon', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('kelas_id', 'Kelas') !!}
            {!! Form::select('kelas_id', ['1' => 'Sepuluh', '2' => 'Sebelas','3' => 'Duabelas'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('photo', 'Foto') !!}
            {!! Form::file('photo', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('alamat', 'Alamat') !!}
            {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
