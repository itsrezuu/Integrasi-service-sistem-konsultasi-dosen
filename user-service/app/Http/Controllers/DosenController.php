<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Http\Resources\DosenResource;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index()
    {
        $Dosen = Dosen::all();
        return new DosenResource($Dosen, 'Success', 'List Dosen');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:dosen,nip',
            'nama' => 'required',
            'prodi' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return new DosenResource(null, 'Failed', $validator->errors());
        }

        $Dosen = Dosen::create($request->all());
        return new DosenResource($Dosen, 'Success', 'Data berhasil ditambahkan');
    }

    public function show(int $nip)
    {
        $Dosen = Dosen::where('nip', '=', $nip)->first();

        if ($Dosen) {
            return new DosenResource($Dosen, 'Success', 'Data ditemukan');
        } else {
            return new DosenResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, int $nip)
    {
        $Dosen = Dosen::where('nip', '=', $nip)->first();

        if ($Dosen) {
            $Dosen->update($request->all());
            return new DosenResource($Dosen, 'Success', 'Data berhasil diupdate');
        } else {
            return new DosenResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }

    public function destroy(int $nip)
    {
        $Dosen = Dosen::where('nip', '=', $nip)->first();

        if ($Dosen) {
            $Dosen->delete();
            return new DosenResource($Dosen, 'Success', 'Data berhasil dihapus');
        } else {
            return new DosenResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }
}
