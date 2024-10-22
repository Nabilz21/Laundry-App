<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $title = "Pesanan";
        $pesanan = Pesanan::latest()->get();

        return view('admin.pesanan.index', compact('title', 'pesanan'));
    }

    public function create()
    {
        $title = "Tambah Pesanan";
        $pelanggan = User::where('level', 'Pelanggan')->latest()->get();
        $paket = Paket::latest()->get();

        return view('admin.pesanan.create', compact('title', 'pelanggan', 'paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan' => 'required',
            'paket' => 'required',
            'berat' => 'required',
            'total_harga' => 'required',
        ]);
        $pesanan_terakhir = Pesanan::max('id') ?? 0;
        $no_invoice = 'INV-' . date('Y/m/d') . '/' . ($pesanan_terakhir + 1);

        $pesanan = new Pesanan();
        $pesanan->no_invoice = $no_invoice;
        $pesanan->creator_id = auth()->user()->id;
        $pesanan->paket_id = $request->paket;
        $pesanan->pelanggan_id = $request->pelanggan;
        $pesanan->berat = $request->berat;
        $pesanan->total_harga = preg_replace('/[^0-9]/', '', $request->total_harga);
        $pesanan->tanggal_pesanan = date('Y-m-d H:i:s');
        $pesanan->status = 'Pending';
        $pesanan->save();

        if ($pesanan) {
            return redirect()->route('pesanan.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pesanan Berhasil Ditambahkan');
        } else {
            return redirect()->route('pesanan.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pesanan Gagal Ditambahkan');
        }
    }

    public function show($id)
    {
        $title = "Detail Pesanan";
        $pesanan = Pesanan::find($id);
        return view('admin.pesanan.show', compact('title', 'pesanan'));
    }

    public function edit($id)
    {
        $title = "Edit Pesanan";
        $pesanan = Pesanan::find($id);
        $pelanggan = User::where('level', 'Pelanggan')->latest()->get();
        $paket = Paket::latest()->get();
        $status = ['Pending', 'Diproses', 'Selesai', 'Diterima'];
        $pesanan->total_harga = 'Rp ' . number_format($pesanan->total_harga, 0, ',', '.');

        return view('admin.pesanan.edit', compact('title', 'pesanan', 'pelanggan', 'paket', 'status'));
    }


    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);

        // Untuk tombol diterima di show
        if ($request->has('status') && $request->status == 'Diterima') {
            $pesanan->status = 'Diterima';
            $pesanan->tanggal_diterima = date('Y-m-d H:i:s');
        } else {
            $request->validate([
                'pelanggan' => 'required',
                'paket' => 'required',
                'berat' => 'required',
                'total_harga' => 'required',
                'status' => 'required',
            ]);

            $pesanan->paket_id = $request->paket;
            $pesanan->pelanggan_id = $request->pelanggan;
            $pesanan->berat = $request->berat;
            $pesanan->total_harga = preg_replace('/[^0-9]/', '', $request->total_harga);
            $pesanan->status = $request->status;

            if ($request->status == 'Diproses') {
                $pesanan->tanggal_pesanan = date('Y-m-d H:i:s');
            } elseif ($request->status == 'Selesai') {
                $pesanan->tanggal_pesanan = date('Y-m-d H:i:s');
            }
        }

        $pesanan->save();

        if ($pesanan) {
            return redirect()->route('pesanan.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pesanan Berhasil Diubah');
        } else {
            return redirect()->route('pesanan.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pesanan Gagal Diubah');
        }
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id);

        if ($pesanan) {
            $pesanan->delete();
            return redirect()->route('pesanan.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pesanan Berhasil Dihapus');
        } else {
            return redirect()->route('pesanan.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pesanan Gagal Dihapus');
        }
    }

    public function print($id)
    {
        $pesanan = Pesanan::find($id);
        $tanggal_nota = date(now());

        return view('admin.pesanan.nota-kecil', compact('pesanan', 'tanggal_nota'));
    }
}
