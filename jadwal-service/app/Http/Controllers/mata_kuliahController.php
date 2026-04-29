<?php

namespace App\Http\Controllers;

use App\Models\mata_kuliah;
use App\Http\Resources\mata_kuliahResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class mata_kuliahController extends Controller
{
    public function index()
    {
        $mata_kuliah = mata_kuliah::all();

        if ($mata_kuliah->isEmpty()) {
            return (new mata_kuliahResource(null, 'Failed', 'Data Mata Kuliah tidak ditemukan'))->response()->setStatusCode(404);
        }
        return new mata_kuliahResource($mata_kuliah, 'Success', 'Data Mata Kuliah');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mata_kuliah' => 'required',
            'sks' => 'required',
            'kode_mk' => 'required'
        ]);

        if ($validator->fails()) {
            return (new mata_kuliahResource(null, 'Failed', $validator->errors()))->response()->setStatusCode(400);
        }

        $mata_kuliah = mata_kuliah::create($request->all());
        return new mata_kuliahResource($mata_kuliah, 'Success', 'Data Mata kuliah berhasil dibuat');
    }

    public function show(string $kode_mk)
    {
        $mata_kuliah = mata_kuliah::where('kode_mk', '=', $kode_mk)->first();
        if ($mata_kuliah) {
            return new mata_kuliahResource($mata_kuliah, 'Success', 'Data mata kuliah ditemukan');
        } else {
            return (new mata_kuliahResource(null, 'Failed', 'Data mata kuliah tidak ditemukan'))->response()->setStatusCode(404);
        }
    }

    public function update(Request $request, string $kode_mk)
    {
        $mata_kuliah = mata_kuliah::where('kode_mk', '=', $kode_mk)->first();
        if ($mata_kuliah) {
            $mata_kuliah->update($request->all());
            return new mata_kuliahResource($mata_kuliah, 'Success', 'Data mata kuliah berhasil diupdate');
        } else {
            return (new mata_kuliahResource(null, 'Failed', 'Data mata kuliah tidak ditemukan'))->response()->setStatusCode(404);
        }
    }

    public function destroy(string $kode_mk)
    {
        $mata_kuliah = mata_kuliah::where('kode_mk', '=', $kode_mk)->first();
        if ($mata_kuliah) {
            $mata_kuliah->delete();
            return new mata_kuliahResource($mata_kuliah, 'Success', 'Data mata kuliah berhasil dihapus');
        } else {
            return (new mata_kuliahResource(null, 'Failed', 'Data mata kuliah tidak ditemukan'))->response()->setStatusCode(404);
        }
    }
}
