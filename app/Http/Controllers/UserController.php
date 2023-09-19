<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('master.user.index');
    }

    public function get(Request $request)
    {
        $data = User::orderBy('id')->get();
        return response()->json(['aaData' => $data]);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'username' => 'required|min:3',
            'email' => 'required|email',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = ['status' => false, 'message' => $validator->errors()->all()];
        } else {
            // dd($request);
            User::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'username' => $request->username,
                    'full_name'  => $request->fullname,
                    'email' => $request->email,
                    'password' => bcrypt($request->email),
                    'role' => $request->role,
                ]
            );
            $response = ['status' => true, 'message' => 'Berhasil menyimpan'];
        }

        return response()->json($response);
    }

    public function hapus(Request $request)
    {
        $response = ['status' => false, 'message' => 'Gagal menghapus'];
        $id = request('id');

        if ($id) {
            User::where(['id' => $id])->delete();
            $response = ['status' => true, 'message' => 'Berhasil menghapus'];
        }

        return response()->json($response);
    }
}
