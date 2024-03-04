@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Pendaftaran Outlet</title>


<body>
    <h1 class="text-center mb-4">Tambah Data Pendaftaran Outlite</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pembelianbatu.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pilih Tanggal</label>
                                <input value="{{ old('tanggal') }}" type="date" name="tanggal"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Pilih Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Penjual</label>
                                <select name="id_pegawai" class="form-control">
                                    @foreach ($masterpegawai as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Customer</label>
                                <select name="id_customer" class="form-control">
                                    @foreach ($mastercustomer as $item)
                                    <option value="{{ $item->id }}">{{ $item->namacust }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Batu</label>
                                <select name="id_batu" class="form-control">
                                    @foreach ($masterbatu as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenisbatu }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pembelian</label>
                                <input value="{{ old('berapaton') }}" type="number" name="berapaton" class="form-control"
                                    placeholder="Masukan Kode Toko">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">No Telpon</label>
                                <input value="{{ old('no_telp') }}" type="number" name="no_telp" class="form-control"
                                    placeholder="Masukan Nama Toko">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

























<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@endsection
