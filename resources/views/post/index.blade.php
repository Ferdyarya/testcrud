@extends('layout.template')
@section('content')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href={{ route('posts.create') }} class="btn btn-primary float-end ">Tambah Data + </a>
            <a href={{ route('cetak.pdf') }} target="_blank" class="btn btn-secondary float-end">Cetak Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Tanggal Biaya</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->nama }}</td>
                        <td>{{ $post->tanggal_pinjam }}</td>
                        <td>{{ $post->tanggal_kembali }}</td>
                        <td>{{ $post->biaya }}</td>
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
    <!-- AKHIR DATA -->
@endsection
