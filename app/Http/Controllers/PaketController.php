<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $title = "Paket";
        $paket = Paket::latest()->get();

        return view('admin.paket.index', compact('title', 'paket'));
    }

    public function create()
    {
        $title = "Tambah Paket";

        return view('admin.paket.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required',
        ]);

        $paket = new Paket();
        $paket->nama_paket = $request->nama_paket;
        $paket->harga_paket = preg_replace('/[^0-9]/', '', $request->harga);
        $paket->save();

        if ($paket) {
            return redirect()->route('paket.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Paket Berhasil Ditambahkan');
        } else {
            return redirect()->route('paket.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Paket Gagal Ditambahkan');
        }
    }

    public function edit($id)
    {
        $title = "Edit Paket";
        $paket = Paket::find($id);
        $paket->harga_paket = 'Rp ' . number_format($paket->harga_paket, 0, ',', '.');

        return view('admin.paket.edit', compact('title', 'paket'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required',
        ]);
        $paket = Paket::find($id);
        $paket->nama_paket = $request->nama_paket;
        $paket->harga_paket = preg_replace('/[^0-9]/', '', $request->harga);
        $paket->save();

        if ($paket) {
            return redirect()->route('paket.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Paket Berhasil Diubah');
        } else {
            return redirect()->route('paket.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Paket Gagal Diubah');
        }
    }

    public function destroy($id)
    {
        $paket = Paket::find($id);

        if ($paket) {
            $paket->delete();
            return redirect()->route('paket.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Paket Berhasil Dihapus');
        } else {
            return redirect()->route('paket.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Paket Gagal Dihapus');
        }
    }
}
