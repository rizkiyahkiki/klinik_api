<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan semua data dokter
    public function index()
    {
        $dokters = Dokter::all();

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil ditampilkan',
            'data' => $dokters
        ], 200);
    }

    // Menambahkan data dokter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string|max:255',
        ]);

        $dokter = Dokter::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil ditambahkan',
            'data' => $dokter
        ], 201);
    }

    // Menampilkan detail dokter
    public function show($id)
    {
        $dokter = Dokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data dokter tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dokter
        ], 200);
    }

    // Mengubah data dokter
    public function update(Request $request, $id)
    {
        $dokter = Dokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data dokter tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'spesialis' => 'sometimes|required|string|max:255',
            'jenis_kelamin' => 'sometimes|required|in:laki-laki,perempuan',
            'alamat' => 'sometimes|required|string|max:255',
        ]);

        $dokter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil diperbarui',
            'data' => $dokter
        ], 200);
    }

    // Menghapus data dokter
    public function destroy($id)
    {
        $dokter = Dokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data dokter tidak ditemukan'
            ], 404);
        }

        $dokter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil dihapus'
        ], 200);
    }
}
