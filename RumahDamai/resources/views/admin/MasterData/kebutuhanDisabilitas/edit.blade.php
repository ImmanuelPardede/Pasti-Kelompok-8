@extends('layouts.management.master')

@section('content')
    <div class="container">
        <h2>Edit Jenis Kebutuhan Disabilitas</h2>

        <!-- Tampilkan pesan kesalahan validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kebutuhanDisabilitas.update', $jenisKebutuhanDisabilitas->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jenis_kebutuhan_disabilitas">Jenis Kebutuhan Disabilitas</label>
                <input type="text" class="form-control" name="jenis_kebutuhan_disabilitas"
                    value="{{ old('jenis_kebutuhan_disabilitas', $jenisKebutuhanDisabilitas->jenis_kebutuhan_disabilitas) }}">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $jenisKebutuhanDisabilitas->deskripsi) }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" id="submitButton" class="btn btn-primary mr-2"
                onclick="handleUpdatedConfirmation(event)">Perbarui</button>
        </form>
    </div>
@endsection
