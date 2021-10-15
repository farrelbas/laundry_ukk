<?php

namespace App\Http\Controllers;

use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index()
    {
        $data = Paket::get();
        return response()->json($data);
    }
    public function detail_paket($id_paket)
    {
        $detail = Paket::where('id_paket', $id_paket)->first();
        return Response()->json($detail);
    }
    public function insert_paket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'harga' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = Paket::create([
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Sukses menambahkan data";
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal menambahkan data";
        }
        return Response()->json($data);
    }
    public function update_paket($id_paket, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'harga' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = Paket::where('id_paket', $id_paket)->update([
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Sukses update data";
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal update data";
        }
        return Response()->json($data);
    }
    public function delete_paket($id_paket)
    {
        $hapus = Paket::where('id_paket', $id_paket)->delete();
        if ($hapus) {
            $data['status'] = true;
            $data['message'] = "Sukses delete data";
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal delete data";
        }
        return Response()->json($data);
    }
}
