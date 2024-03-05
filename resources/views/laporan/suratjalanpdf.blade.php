<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #aa0404;
            /* Change link color to a blue shade */
            text-decoration: none;
            /* Remove underline */
        }

        body {
            /* position: relative; */
            /* width: 21cm;
            height: 29.7cm;
            margin: 0 auto; */
            /* Change text color to black */
            color: #000;
            background: #FFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 140px;
            /* Increase logo width */
        }

        h1 {
            border-top: 1px solid #aa0404;
            border-bottom: 1px solid #aa0404;
            color: #aa0404;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: bold;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #aa0404;
            text-align: right;
            width: 80px;
            margin-right: 20px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
            padding: 10px 20px;
        }

        table th {
            color: #aa0404;
            border-bottom: 1px solid #aa0404;
            font-weight: bold;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 10px 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #aa0404;
        }

        #notices .notice {
            color: #aa0404;
            font-size: 1.2em;
        }

        footer {
            color: #aa0404;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #aa0404;
            padding: 8px 0;
            text-align: center;
        }

        .date-container {
            text-align: right;
        }

        .formatted-date {
            font-weight: bold;
            /* Make the date bold */
        }

        .tengah {
            text-align: center;
            line-height: 5px;
            font-size: 12px
        }
    </style>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ public_path('assets/logo.png') }}" alt="logo" width="140px">
        </div>
        <h1>
            <img src="" class="" alt="">
            Surat Jalan
        </h1>
        <h4 class="tengah">CV. RIZKY PERDANA TRANSPORT</h4>
        <p class="tengah">Jl. Trikora No.6, Landasan Ulin Sel., Kec. Liang Anggang, Kota Banjar Baru, Kalimantan Selatan
            70722</p>
        <div id="company" class="clearfix">
            <div>0815267112</div>
            <div><a href="#">cvrizkyperdanatransport@gmail.co.id</a></div>
        </div>
        <div id="project">
            @if (!empty($pembelianbatu))
                @foreach ($pembelianbatu as $item)
                    <div><span>CLIENT</span>{{ $item->mastercustomer->namacust }}</div>
                    <div><span>ADDRESS</span>{{ $item->mastercustomer->alamat }}</div>
                    <div><span>EMAIL</span> <a>{{ $item->mastercustomer->email }}</a></div>
                    <div><span>DATE</span> Banjarmasin, {{ now()->format('d-m-Y') }}</div>
                @endforeach
            @else
                <p>No data available</p>
            @endif
        </div>
    </header>
    <main>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penjual</th>
                    <th>Customer</th>
                    <th>Batu Dibeli</th>
                    <th>Harga</th>
                    <th>Keperluan</th>
                    <th>No Telepon</th>
                    <th>Total</th>
                    {{-- <th>Status</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
    $grandTotal = 0;
@endphp

@if (!empty($pembelianbatu))
    <tbody>
        @foreach ($pembelianbatu as $item)
            <tr>
                <td class="border">{{ $loop->iteration }}</td>
                <td class="border textmid">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                <td class="border textmid">{{ $item->masterpegawai->nama }}</td>
                <td class="border textmid">{{ $item->mastercustomer->namacust }}</td>
                <td class="border textmid">{{ $item->masterbatu->jenisbatu }}</td>
                <td class="border textmid">{{ $item->masterbatu->hargabatu }}</td>
                <td class="border textmid">{{ $item->berapaton }} TON</td>
                <td class="border textmid">{{ $item->no_telp }}</td>
                {{-- <td class="border textmid">{{ $item->status }}</td> --}}

                @php
                    $subTotal = $item->masterbatu->hargabatu * $item->berapaton;
                    $grandTotal += $subTotal;
                @endphp

                <td>Rp. {{ number_format($subTotal) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8">Grand Total</td>
            <td>Rp. {{ number_format($grandTotal) }}</td>
        </tr>
    </tbody>
</table>
<div class="date-container">
    Banjarmasin, <span class="formatted-date">{{ now()->format('d-m-Y') }}</span>
</div>
</main>
<footer>
    <p class="signature">(Manager Oprasional)</p>
</footer>
@else
    <p colspan="8">No data available</p>
@endif
</body>

</html>
