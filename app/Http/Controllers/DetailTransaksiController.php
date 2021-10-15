<?php

namespace App\Http\Controllers;

use App\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $data = DetailTransaksi::get();
        return response()->json($data);
    }
    public function detail_transaksi($id_detail_transaksi)
    {
        $detail = DetailTransaksi::where('id_detail_transaksi', $id_detail_transaksi)->first();
        return Response()->json($detail);
    }
    public function insert_detail_transaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = DetailTransaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'id_paket' => $request->id_paket,
            'qty' => $request->qty,
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
    public function update_detail_transaksi($id_detail_transaksi, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = DetailTransaksi::where('id_detail_transaksi', $id_detail_transaksi)->update([
            'id_transaksi' => $request->id_transaksi,
            'id_paket' => $request->id_paket,
            'qty' => $request->qty,
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
    public function delete_detail_transaksi($id_detail_transaksi)
    {
        $hapus = DetailTransaksi::where('id_detail_transaksi', $id_detail_transaksi)->delete();
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
