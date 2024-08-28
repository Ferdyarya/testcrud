@extends('layout.template')

@section('content')
    <!-- START FORM -->
    <form action={{ route('dosen.update', $item->id) }} method='post'>
        @csrf
        @method('put')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="form-group">
                <label for="namadosen">Nama Dosen</label>
                <input type="text" name="namadosen" class="form-control"
                       placeholder="Masukan Nama Dosen" value="{{ old('namadosen', $item->namadosen) }}" required>
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="number" name="nip" class="form-control"
                       placeholder="Masukan NIP" value="{{ old('nip', $item->nip) }}" required>
            </div>
            <div class="form-group">
                <label for="tanggallahir">Tanggal Lahir</label>
                <input type="date" name="tanggallahir" class="form-control"
                       placeholder="Masukan Tanggal Lahir" value="{{ old('tanggallahir', $item->tanggallahir) }}" required>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-1"><button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <!-- AKHIR FORM -->
@endsection
