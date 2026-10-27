<?php

namespace App\Http\Controllers;

use App\Models\Housekeeper;
use Illuminate\Http\Request;

class HousekeeperController extends Controller
{
    public function index()
    {
        $housekeepers = Housekeeper::all();
        return view('housekeepers.index', compact('housekeepers'));
    }

    public function create()
    {
        return view('housekeepers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tugas_harian' => 'required|string|max:255',
            'area_penanganan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Cuti,Nonaktif',
        ]);

        Housekeeper::create($request->all());

        return redirect()->route('housekeepers.index')->with('success', 'Data housekeeper berhasil ditambahkan.');
    }

    public function show(Housekeeper $housekeeper)
    {
        return view('housekeepers.show', compact('housekeeper'));
    }

    public function edit(Housekeeper $housekeeper)
    {
        return view('housekeepers.edit', compact('housekeeper'));
    }

    public function update(Request $request, Housekeeper $housekeeper)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tugas_harian' => 'required|string|max:255',
            'area_penanganan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Cuti,Nonaktif',
        ]);

        $housekeeper->update($request->all());

        return redirect()->route('housekeepers.index')->with('success', 'Data housekeeper berhasil diperbarui.');
    }

    public function destroy(Housekeeper $housekeeper)
    {
        $housekeeper->delete();

        return redirect()->route('housekeepers.index')->with('success', 'Data housekeeper berhasil dihapus.');
    }
}