<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;


class guruController extends Controller
{

    public function index()
    {
        return view('master.guru.index');
    }

    public function get(Request $request)
    {
        $data = Guru::orderBy('id')->get();
        return response()->json(['aaData' => $data]);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nama_lengkap' => 'required|min:3',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = ['status' => false, 'message' => $validator->errors()->all()];
        } else {
            Guru::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_lengkap' => $request->nama_lengkap,
                    'nik'  => $request->nik,
                    'kelamin' => $request->kelamin,
                    'bidang_studi' => $request->bidang_studi,
                    'alamat' => $request->alamat,
                    'handphone' => $request->handphone,
                ]
            );
            $response = ['status' => true, 'message' => 'Berhasil menyimpan'];
        }

        return response()->json($response);
    }

}
