<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $jumlahDataAdmin = User::where('level', 'Admin')->count();
        $jumlahDataPelanggan = User::where('level', 'Pelanggan')->count();
        $jumlahDataPesanan = Pesanan::count();

        $jumlahPesananPending = Pesanan::where('status', 'pending')->count();
        $jumlahPesananDiproses = Pesanan::where('status', 'Diproses')->count();
        $jumlahPesananSelesai = Pesanan::where('status', 'Selesai')->count();
        $jumlahPesananDiterima = Pesanan::where('status', 'Diterima')->count();

        return view('admin.dashboard.index', compact(
            'title',
            'jumlahDataAdmin',
            'jumlahDataPelanggan',
            'jumlahDataPesanan',
            'jumlahPesananPending',
            'jumlahPesananDiproses',
            'jumlahPesananSelesai',
            'jumlahPesananDiterima'
        ));
    }
}
