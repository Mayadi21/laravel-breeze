<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function create()
    {
           
    }

    public function store(Request $request)
    {
        // Validate and store the data
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|string|max:255',
        ]);
        Mahasiswa::create($request->all());

        $notification = [
            'message' => 'Data Mahasiswa Berhasil Ditambahkan',
            'alert-type' => 'success'
        ];
        return redirect()->route('dashboard')->with($notification);
        // Redirect or return a response
    }

    public function show($id)
    {
        // Retrieve and display a specific mahasiswa
    }

    public function edit($id)
    {
        // Retrieve and display the edit form for a specific mahasiswa
    }

    public function update(Request $request, $id)
    {
        // Validate and update the data
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|string|max:255',
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        $notification = [
            'message' => 'Data Mahasiswa Berhasil Diperbarui',
            'alert-type' => 'success'
        ];
        return redirect()->route('dashboard')->with($notification);
    }

    public function destroy($id)
    {
        // Delete the specified mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        $notification = [
            'message' => 'Data Mahasiswa Berhasil Dihapus',
            'alert-type' => 'info'
        ];
        return redirect()->route('dashboard')->with($notification);
    }   
}
