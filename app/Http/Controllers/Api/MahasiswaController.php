<?php

namespace App\Http\Controllers\Api;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Assuming $mahasiswa is being fetched somewhere in this method
        $mahasiswa = Mahasiswa::all();

        return new MahasiswaResource(true, 'List Data Mahasiswas', $mahasiswa);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'NIM' => 'required|unique:mahasiswas,NIM',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telepon' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create mahasiswa
        $mahasiswa = Mahasiswa::create([
            'NIM' => $request->NIM,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
        ]);

        // Return response
        return response()->json(
            [
                'success' => true,
                'message' => 'Data Mahasiswa Berhasil Ditambahkan!',
                'data' => $mahasiswa,
            ],
            201,
        );
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        return new MahasiswaResource(true, 'Detail Data Mahasiswa!', $mahasiswa);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'NIM' => 'required|unique:mahasiswas,NIM,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telepon' => 'required|numeric',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find mahasiswa by ID
        $mahasiswa = Mahasiswa::find($id);

        // Check if mahasiswa exists
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data Mahasiswa Tidak Ditemukan'], 404);
        }

        // Update mahasiswa
        $mahasiswa->update([
            'NIM' => $request->NIM,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
        ]);

        return new MahasiswaResource(true, 'Berhasil Update Data Mahasiswa!', $mahasiswa);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->delete();

        //return response
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}
