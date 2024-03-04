<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        body {
            font-family: arial;

        }

        table {
            border-bottom: 4px solid #000;
            /* padding: 2px */
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        #warnatable th {
            padding-top: 12px;
            padding-bottom: 12px;
            /* text-align: left; */
            background-color: #aa0404;
            color: white;
            /* text-align: center; */
        }

        #warnatable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #warnatable tr:hover {
            background-color: #ddd;
        }

        .textmid {
            /* text-align: center; */
        }

        .signature {
            position: absolute;
            margin-top: 20px;
            text-align: right;
            right: 50px;
            font-size: 14px;
        }

        .date-container {
            font-family: arial;
            text-align: left;
            font-size: 14px;
        }
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="{{ public_path('assets/logo.png') }}" alt="logo" width="140px"></td>
                <td class="tengah">
                    <h4>CV. RIZKY PERDANA TRANSPORT</h4>
                    <p>Jl. Trikora No.6, Landasan Ulin Sel., Kec. Liang Anggang, Kota Banjar Baru, Kalimantan Selatan
                        70722</p>
                </td>
            </tr>
        </table>
    </div>

    <center>
        <h5 class="mt-4">Rekap Laporan Barang Masuk</h5>
    </center>



    <br>

    <table class='table table-bordered' id="warnatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Batu</th>
                <th>Qty</th>
                <th>Dari Supplier</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
            $grandTotal = 0;
            @endphp --}}

            @foreach ($laporanbatumasuk as $item)
                <tr>
                    <td class="border">{{ $loop->iteration }}</td>
                    <td class="border textmid">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}
                    </td>
                    <td class="border textmid">{{ $item->jenisbatu }}</td>
                    <td class="border textmid">{{ $item->qty }} TON</td>
                    <td class="border textmid">{{ $item->mastersupplier->namapt }}</td>
                </tr>
            @endforeach
            {{-- <tr>
                <td colspan="7">Grand Total</td>
                <td>Rp. {{ number_format($grandTotal)}}</td>
            </tr> --}}
        </tbody>
    </table>
    <div class="date-container">
        Banjarmasin, <span class="formatted-date">{{ now()->format('d-m-Y') }}</span>
    </div>
    <p class="signature">(Manager Operasional)</p>
</body>

</html>
