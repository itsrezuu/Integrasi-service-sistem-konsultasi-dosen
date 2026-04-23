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
        return new mata_kuliahResource($mata_kuliah, 'Berhasil', 'Data Mata Kuliah');
    }
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mata_kuliah' => 'required',
            'sks' => 'required',
            'kode_mk' => 'required'
        ]);

        if ($validator->fails()) {
            return new mata_kuliahResource(null, 'Gagal', $validator->errors());
        }

        $mata_kuliah = mata_kuliah::create($request->all());
        return new mata_kuliahResource($mata_kuliah, 'Sukses', 'Data Mata kuliah berhasil dibuat');
    }

    public function show($id)
    {
        $mata_kuliah = mata_kuliah::find($id);
        if ($mata_kuliah) {
            return new mata_kuliahResource($mata_kuliah, 'Sukses', 'Data mata kuliah ditemukan');
        } else {
            return new mata_kuliahResource(null, 'gagal', 'Data mata kuliah tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $mata_kuliah = mata_kuliah::find($id);
        if ($mata_kuliah) {
            $mata_kuliah->update($request->all());
            return new mata_kuliahResource($mata_kuliah, 'Sukses', 'Data mata kuliah berhasil diupdate');
        } else {
            return new mata_kuliahResource(null, 'Gagal', 'Data mata kuliah tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $mata_kuliah = mata_kuliah::find($id);
        if ($mata_kuliah) {
            $mata_kuliah->delete();
            return new mata_kuliahResource($mata_kuliah, 'Sukses', 'Data mata kuliah berhasil dihapus');
        } else {
            return new mata_kuliahResource(null, 'Gagal', 'Data mata kuliah tidak ditemukan');
        }
    }

}
