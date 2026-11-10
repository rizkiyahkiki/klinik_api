<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Menampilkan semua data pasien
    public function index()
    {
        $pasiens = Pasien::all();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil ditampilkan',
            'data' => $pasiens
        ], 200);
    }

    // Menambahkan data pasien
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pasien' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string',
            'foto' => 'nullable|string|max:255',
        ]);

        $pasien = Pasien::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil ditambahkan',
            'data' => $pasien
        ], 201);
    }

    // Menampilkan detail pasien
    public function show($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Data pasien tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pasien
        ], 200);
    }

    // Mengubah data pasien
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Data pasien tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'no_pasien' => 'sometimes|required|string|max:255',
            'nama' => 'sometimes|required|string|max:255',
            'umur' => 'sometimes|required|integer',
            'jenis_kelamin' => 'sometimes|required|in:laki-laki,perempuan',
            'alamat' => 'sometimes|required|string',
            'foto' => 'nullable|string|max:255',
        ]);

        $pasien->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diperbarui',
            'data' => $pasien
        ], 200);
    }

    // Menghapus data pasien
    public function destroy($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Data pasien tidak ditemukan'
            ], 404);
        }

        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus'
        ], 200);
    }
}
