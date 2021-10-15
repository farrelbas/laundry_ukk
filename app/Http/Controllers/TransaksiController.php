<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::get();
        return response()->json($data);
    }
    public function detail_transaksi($id_transaksi)
    {
        $detail = Transaksi::where('id_transaksi', $id_transaksi)->first();
        return Response()->json($detail);
    }
    public function insert_transaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = Transaksi::create([
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
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
    public function update_transaksi($id_transaksi, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = Transaksi::where('id_transaksi', $id_transaksi)->update([
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
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
    public function delete_transaksi($id_transaksi)
    {
        $hapus = Transaksi::where('id_transaksi', $id_transaksi)->delete();
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
