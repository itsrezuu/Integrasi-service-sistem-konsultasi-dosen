<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Resources\jadwalResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            'id_dosen' => 'required',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kode_mk' => 'required'
        ]);

        $response = Http::get('http://127.0.0.1:8000/api/dosen/' . $request->id_dosen);

        if ($validator->fails()) {
            return new jadwalResource(null, 'Gagal', $validator->errors());
        }
        $dosen = $response->json();
        if ($dosen['data'] != null) {
            $jadwal = Jadwal::create($request->all());
            return new jadwalResource([$jadwal, $dosen['data']], 'Sukses', 'Data jadwal berhasil dibuat');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data dosen tidak ditemukan');
        }
    }

    public function show(int $id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            return new jadwalResource($jadwal, 'Sukses', 'Data jadwal ditemukan');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data jadwal tidak ditemukan');
        }
    }

    public function update(Request $request, int $id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->update($request->all());
            return new jadwalResource($jadwal, 'Sukses', 'Data jadwal berhasil diupdate');
        } else {
            return new jadwalResource(null, 'Gagal', 'Data jadwal tidak ditemukan');
        }
    }

    public function destroy(int $id)
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