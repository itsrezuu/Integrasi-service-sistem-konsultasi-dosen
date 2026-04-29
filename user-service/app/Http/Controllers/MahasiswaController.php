<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MahasiswaResource;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $Mahasiswa = mahasiswa::all();
        return new MahasiswaResource($Mahasiswa, 'Success', 'List Mahasiswa');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'prodi' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return new MahasiswaResource(null, 'Failed', $validator->errors());
        }

        $Mahasiswa = mahasiswa::create($request->all());
        return new MahasiswaResource($Mahasiswa, 'Success', 'Data berhasil ditambahkan');
    }

    public function show(int $nim)
    {
        $Mahasiswa = mahasiswa::where('nim', '=', $nim)->first();

        if ($Mahasiswa) {
            return new MahasiswaResource($Mahasiswa, 'Success', 'Data ditemukan');
        } else {
            return new MahasiswaResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, int $nim)
    {
        $Mahasiswa = mahasiswa::where('nim', '=', $nim)->first();

        if ($Mahasiswa) {
            $Mahasiswa->update($request->all());
            return new MahasiswaResource($Mahasiswa, 'Success', 'Data berhasil diupdate');
        } else {
            return new MahasiswaResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }

    public function destroy(int $nim)
    {
        $Mahasiswa = mahasiswa::where('nim', '=', $nim)->first();

        if ($Mahasiswa) {
            $Mahasiswa->delete();
            return new MahasiswaResource($Mahasiswa, 'Success', 'Data berhasil dihapus');
        } else {
            return new MahasiswaResource(null, 'Failed', 'Data tidak ditemukan');
        }
    }
}