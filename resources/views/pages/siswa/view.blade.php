@extends('layouts.app')
@section('title', 'User View')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Form View siswa</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <img src="{{ asset('storage/photos/' . $model->photo) }}" alt="" width="300px">
                </div>
                <div class="col-lg-8">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $model->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td>{{ $model->nis }}</td>
                        </tr>
                        <tr>
                            <td>Tempat lahir</td>
                            <td>:</td>
                            <td>{{ $model->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal lahir</td>
                            <td>:</td>
                            <td>{{ $model->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $model->jenis_kelamin }}</td>
                        </tr>

                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            @php
                                $numberMappings = [
                                    1 => 'sepuluh',
                                    2 => 'sebelas',
                                    3 => 'dua belas',
                                ];
                            @endphp
                            <td>{{ $numberMappings[$model->kelas_id] ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>:</td>
                            <td>{{ $model->telepon }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $model->alamat }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['siswa.delete', $model->id],
                'style' => 'display:inline',
                'onsubmit' => 'return confirm("Apakah Anda yakin ingin menghapus data ini?");',
            ]) !!}
            {!! Form::button(__('Delete'), ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
