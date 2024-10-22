<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 3rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.rem;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Pesanan SI Laundry</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Pelanggan</th>
                <th>Alamat</th>
                <th>No Hp</th>
                <th>Paket</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Total Harga</th>
                <th>Tanggal Pesanan</th>
                <th>Tanggal Diproses</th>
                <th>Tanggal Selesai</th>
                <th>Tanggal Diterima</th>
                <th>Creator</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->no_invoice }}</td>
                    <td>{{ $item->pelanggan->nama }}</td>
                    <td>{{ $item->pelangganAsli->alamat }}</td>
                    <td>{{ $item->pelangganAsli->no_hp }}</td>
                    <td>{{ $item->paket->nama_paket }}</td>
                    <td>Rp {{ number_format($item->paket->harga_paket, 0, ',', '.') }}</td>
                    <td>{{ $item->berat }} Kg</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y h:i:s') }}</td>
                    <td>{{ $item->tanggal_proses ? \Carbon\Carbon::parse($item->tanggal_proses)->format('d F Y h:i:s') : 'Belum diproses' }}
                    </td>
                    <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y h:i:s') : 'Belum selesai' }}
                    </td>
                    <td>{{ $item->tanggal_diterima ? \Carbon\Carbon::parse($item->tanggal_diterima)->format('d F Y h:i:s') : 'Belum diterima' }}
                    </td>
                    <td>{{ $item->creator->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
