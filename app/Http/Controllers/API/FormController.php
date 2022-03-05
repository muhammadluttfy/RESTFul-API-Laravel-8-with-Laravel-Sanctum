<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns',
            'jurusan' => 'required',
            'no_telp' => 'required|numeric',
        ]);

        // dd($request->all());

        $student = new Student;
        $student->nim = $request->nim;
        $student->nama = $request->nama;
        $student->email = $request->email;
        $student->jurusan = $request->jurusan;
        $student->no_telp = $request->no_telp;
        $student->save();

        return response()->json([
            'message' => 'Selamat, data mahasiswa ' . $student->nama . ' berhasil ditambahkan',
            'data_student' => $student,
        ], 200);
    }

    public function edit($id)
    {
        $student = Student::find($id);

        return response()->json([
            'message' => 'Success!',
            'data_student' => $student,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns',
            'jurusan' => 'required',
            'no_telp' => 'required|numeric',
        ]);

        $student->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'no_telp' => $request->no_telp,
        ]);

        return response()->json([
            'message' => 'Student data has been successfully updated',
            'data_student' => $student,
        ], 200);
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();

        return response()->json([
            'message' => 'Student data has been successfully deleted',
        ], 200);
    }
}
