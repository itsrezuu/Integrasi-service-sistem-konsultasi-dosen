<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Resources\jadwalResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return new jadwalResource($jadwal, 'Berhasil', 'Data Jadwal');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kode_mk' => 'required'
        ]);

        if ($validator->fails()) {
            return new jadwalResource(null, 'Gagal', $validator->errors());
        }

        $jadwal = Jadwal::create($request->all());
        return new jadwalResource($jadwal, 'Sukses', 'Data jadwal berhasil dibuat');
    }

    public function show($id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            return new jadwalResource($jadwal, 'Sukses', 'Data jadwal ditemukan');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data jadwal tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->update($request->all());
            return new jadwalResource($jadwal, 'Sukses', 'Data jadwal berhasil diupdate');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data jadwal tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->delete();
            return new jadwalResource($jadwal, 'Sukses', 'Data jadwal berhasil dihapus');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data jadwal tidak ditemukan');
        }
    }
}
