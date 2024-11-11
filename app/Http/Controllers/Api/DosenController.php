<?php

namespace App\Http\Controllers\Api;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DosenResource;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index()
    {
        // Assuming $Dosen is being fetched somewhere in this method
        $dosen = Dosen::all();

        // Correct return statement
        return new DosenResource(true, 'List Data Dosen', $dosen);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'NIP' => 'required|unique:dosens,NIP',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telepon' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create Dosen
        $dosen = Dosen::create([
            'NIP' => $request->NIP,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
        ]);

        // Return response
        return response()->json(
            [
                'success' => true,
                'message' => 'Data Dosen Berhasil Ditambahkan!',
                'data' => $dosen,
            ],
            201,
        );
    }
    public function show($id)
    {
        $dosen = Dosen::find($id);

        return new DosenResource(true, 'Detail Data Dosen!', $dosen);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'NIP' => 'required|unique:Dosens,NIP,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telepon' => 'required|numeric',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Dosen by ID
        $dosen = Dosen::find($id);

        // Check if Dosen exists
        if (!$dosen) {
            return response()->json(['message' => 'Data Dosen Tidak Ditemukan'], 404);
        }

        // Update Dosen
        $dosen->update([
            'NIM' => $request->NIM,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
        ]);

        return new DosenResource(true, 'Berhasil Update Data Dosen!', $dosen);
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        $dosen->delete();

        //return response
        return new DosenResource(true, 'Data Dosen Berhasil Dihapus!', null);
    }
}
