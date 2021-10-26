<?php

namespace App\Http\Controllers;

use App\UserModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //CRUD

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();

        return Response()->json(['message' => 'Berhasil mendaftar']);
    }


    //CRUD

    public function index()
    {
        $data = UserModel::get();
        return response()->json($data);
    }
    public function detail_user($id_user)
    {
        $detail = UserModel::where('id_user', $id_user)->first();
        return Response()->json($detail);
    }
    public function insert_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = UserModel::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
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
    public function update_user($id_user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = $validator->errors();
            return Response()->json($data);
        }
        $simpan = UserModel::where('id_user', $id_user)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
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
    public function delete_user($id_user)
    {
        $hapus = UserModel::where('id_user', $id_user)->delete();
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
