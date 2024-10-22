<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan';
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $filter = $request->input('filter');

        // Inisialisasi query
        $laporan = Pesanan::query();

        // Filter berdasarkan kalender
        if ($tanggal_awal && $tanggal_akhir) {
            // Memfilter berdasarkan 'created_at' dan 'updated_at'
            $laporan->where(function ($query) use ($tanggal_awal, $tanggal_akhir) {
                $query->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                    ->orWhereBetween('updated_at', [$tanggal_awal, $tanggal_akhir]);
            });
        }

        // Filter berdasarkan pilihan dropdown
        if ($filter) {
            switch ($filter) {
                case 'semua':
                    // Dikosongkan untuk menampilkan semua data
                    break;
                case 'hari_ini':
                    $laporan->where(function ($query) {
                        $query->whereDate('created_at', Carbon::today())
                            ->orWhereDate('updated_at', Carbon::today());
                    });
                    break;

                case 'minggu_ini':
                    $laporan->where(function ($query) {
                        $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    });
                    break;

                case 'bulan_ini':
                    $laporan->where(function ($query) {
                        $query->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->orWhereMonth('updated_at', Carbon::now()->month)
                            ->whereYear('updated_at', Carbon::now()->year);
                    });
                    break;

                case 'tahun_ini':
                    $laporan->where(function ($query) {
                        $query->whereYear('created_at', Carbon::now()->year)
                            ->orWhereYear('updated_at', Carbon::now()->year);
                    });
                    break;
            }
        }

        // Ambil data laporan dengan query yang sudah difilter
        $laporan = $laporan->latest()->get();

        return view('admin.laporan.index', compact('title', 'laporan'));
    }

    public function exportPDF()
    {
        $laporan = Pesanan::all();

        // Render ke view yang akan diubah ke PDF
        $pdf = PDF::loadView('admin.laporan.exportPDF', compact('laporan'))->setPaper('a4', 'landscape');

        return $pdf->download('laporan_pesanan.pdf');
    }
}
