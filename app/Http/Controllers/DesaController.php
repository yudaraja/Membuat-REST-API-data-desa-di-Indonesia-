<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::paginate(15);
        return response()->json($desas);
    }

    public function show($id)
    {
        $desa = Desa::find($id);
        if ($desa) {
            return response()->json($desa);
        } else {
            return response()->json(['message' => 'Desa tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:indonesia_villages,code',
            'meta' => 'nullable|array',
            'meta.lat' => 'nullable|numeric',
            'meta.long' => 'nullable|numeric',
            'meta.pos' => 'nullable|string|max:10',
            'district_code' => 'required|string|exists:indonesia_districts,code',
        ], [
            'name.required' => 'Nama desa harus diisi.',
            'name.string' => 'Nama desa harus berupa string.',
            'name.max' => 'Nama desa maksimal 255 karakter.',
            'code.required' => 'Kode desa harus diisi.',
            'code.string' => 'Kode desa harus berupa string.',
            'code.unique' => 'Kode desa sudah digunakan.',
            'meta.array' => 'Meta harus berupa array.',
            'meta.lat.numeric' => 'Latitude harus berupa angka.',
            'meta.long.numeric' => 'Longitude harus berupa angka.',
            'meta.pos.string' => 'Kode pos harus berupa string.',
            'meta.pos.max' => 'Kode pos maksimal 10 karakter.',
            'district_code.required' => 'Kode kecamatan harus diisi.',
            'district_code.string' => 'Kode kecamatan harus berupa string.',
            'district_code.exists' => 'Kode kecamatan tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $desa = Desa::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $desa
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:indonesia_villages,code,' . $id,
            'meta' => 'nullable|array',
            'meta.lat' => 'nullable|numeric',
            'meta.long' => 'nullable|numeric',
            'meta.pos' => 'nullable|string|max:10',
            'district_code' => 'required|string|exists:indonesia_districts,code',
        ], [
            'name.required' => 'Nama desa harus diisi.',
            'name.string' => 'Nama desa harus berupa string.',
            'name.max' => 'Nama desa maksimal 255 karakter.',
            'code.required' => 'Kode desa harus diisi.',
            'code.string' => 'Kode desa harus berupa string.',
            'code.unique' => 'Kode desa sudah digunakan.',
            'meta.array' => 'Meta harus berupa array.',
            'meta.lat.numeric' => 'Latitude harus berupa angka.',
            'meta.long.numeric' => 'Longitude harus berupa angka.',
            'meta.pos.string' => 'Kode pos harus berupa string.',
            'meta.pos.max' => 'Kode pos maksimal 10 karakter.',
            'district_code.required' => 'Kode kecamatan harus diisi.',
            'district_code.string' => 'Kode kecamatan harus berupa string.',
            'district_code.exists' => 'Kode kecamatan tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Desa tidak ditemukan.'
            ], 404);
        }

        $desa->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $desa
        ], 200);
    }

    public function destroy($id)
    {
        $desa = Desa::find($id);
        if ($desa) {
            $desa->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Desa berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Desa tidak ditemukan.'
            ], 404);
        }
    }
}
