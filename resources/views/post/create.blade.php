@extends('layout.template')

@section('content')
    <!-- START FORM -->
    <form action={{ route('posts.store') }} method='post'>
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" required name='nama' id="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="detail" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" required name='tanggal_pinjam' id="tanggal_pinjam">
                </div>
            </div>
             <div class="mb-3 row">
                <label for="detail" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" required name='tanggal_kembali' id="tanggal_kembali">
                </div>
            </div>
             <div class="mb-3 row">
                <label for="detail" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" required name='biaya' id="biaya">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-1"><button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <!-- AKHIR FORM -->
@endsection
