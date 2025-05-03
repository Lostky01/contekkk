<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    public function index() {
        $data = Siswa::all();
        return view('main', compact('data'));
    }
    
    public function create() {
        return view('add-siswa');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' =>'required',
            'nisn' =>'required',
            'tempat_lahir' =>'required',
            'tanggal_lahir' =>'required',
            'alamat' =>'required',
            'telepon' =>'required'
        ]);

        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->nisn = $request->nisn;
        $siswa->tempat_lahir = $request->tempat_lahir;  
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->telepon = $request->telepon;
        /* dd($siswa); */
        $siswa->save();
        return redirect()->route('main');
    }

    public function edit($id) {
        $siswa = Siswa::findOrFail($id);
        return view('edit-siswa', compact('siswa'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' =>'required',   
            'nisn' => 'required',         
            'tempat_lahir' =>'required',
            'tanggal_lahir' =>'required',
            'alamat' =>'required',
            'telepon' =>'required'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->nisn = $request->nisn;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->telepon = $request->telepon;
        /* dd($siswa); */
        $siswa->save();
        return redirect()->route('main');
    }

    public function destroy($id) {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->route('main');
    }

    public function viewPDF()
    {
        $data = Siswa::all();
        $pdf = PDF::loadView('pdf', array('data' =>  $data))
        ->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function downloadPDF()
    {
        $data = Siswa::all();
        $pdf = PDF::loadView('pdf', array('data' =>  $data))
        ->setPaper('a4', 'portrait');
        return $pdf->download('data.pdf');

    }

}


# how to use dompdf to export?
# https://stackoverflow.com/questions/52872290/how-to-use-dompdf-to-export-a-view-in-laravel
# https://github.com/barryvdh/laravel-dompdf
# https://www.positronx.io/how-to-export-pdf-file-in-laravel-using-dompdf/