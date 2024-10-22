<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print - Nota Kecil | SI Laundry</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template-admin/src/assets/images/logos/favicon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 6px;
        }

        img {
            max-width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .alamat {
            padding: 8px 0;
            display: flex;
            text-align: center;
            flex-direction: column;
            gap: 4px;
        }

        .padding-tb-2 {
            padding: 2px 0;
        }

        .fs-10-fw-bold {
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div>
        <img src="{{ asset('template-admin/src/assets/images/logos/dark-logo.svg') }}" alt="">
        <div class="alamat">
            <a>Laundry</a>
            <a>Dsn, Jl. Jogodayoh Jabon, RT.05/RW.2, Jokodayo, Jabon, Kec. Mojoanyar, Kabupaten Mojokerto, Jawa Timur
                61364</a>
            <a>0821-4005-1717</a>
        </div>
        <table>
            <tr>
                <td>No Nota</td>
                <td align="right">{{ $pesanan->no_invoice }}</td>
            </tr>
            <tr>
                <td>Creator</td>
                <td align="right">{{ $pesanan->creator->nama }}</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td align="right">{{ $pesanan->pelanggan->nama }}</td>
            </tr>
            <tr>
                <td>Status Pesanan</td>
                <td align="right">{{ $pesanan->status }}</td>
            </tr>
            <tr>
                <td class="padding-tb-2" colspan="2">=========================================================</td>
            </tr>
            <tr>
                <td>{{ $pesanan->berat }} Kg x {{ 'Rp ' . number_format($pesanan->paket->harga_paket, 0, ',', '.') }}
                </td>
                <td align="right">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="padding-tb-2" colspan="2">=========================================================</td>
            </tr>
            <tr>
                <td class="fs-10-fw-bold">Total</td>
                <td align="right">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="padding-tb-2" colspan="2" align="center">
                    ====================={{ $pesanan->tanggal_pesanan }}=====================</td>
            </tr>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
