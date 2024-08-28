@extends('layout.template')
@section('content')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href={{ route('dosen.create') }} class="btn btn-primary float-end ">Tambah Data + </a>
            <a href={{ route('cetak.pdf') }} target="_blank" class="btn btn-secondary float-end">Cetak Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="px-6 py-2">Dosen</th>
                    <th class="px-6 py-2">Nip</th>
                    <th class="px-6 py-2">Tanggal Lahir</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($dosen as $index => $item)
                    <tr>
                        <th class="px-6 py-2">{{ $index + $dosen->firstItem() }}</th>
                        <td class="px-6 py-2">{{ $item->namadosen }}</td>
                        <td class="px-6 py-2">{{ $item->nip }}</td>
                        <td class="px-6 py-2">{{ $item->tanggallahir }}</td>
                        <td>
                            <a href="{{ route('dosen.edit', $item->id)}}" class="btn btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </tbody>

        </table>

    </div>
    <!-- AKHIR DATA -->
@endsection
