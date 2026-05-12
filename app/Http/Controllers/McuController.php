<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\RegSIMRS;

class McuController extends Controller
{
    public function index()
    {
        try {
            $data = RegSIMRS::get()->toArray();
        } catch (\Exception $e) {
            $data = [];
        }

        return view('capture', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_mr' => 'required',
            'reg_no' => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
            'tgl_lahir' => 'required',
            'foto' => 'required',
            'pekerjaan' => 'nullable',
            'deskripsi' => 'required',
        ]);

        $tanggal = explode('.', $request->tanggal)[0];

        $pekerjaan = $request->pekerjaan;
        if (empty($pekerjaan) || strlen($pekerjaan) <= 1) {
            $pekerjaan = null;
        }

        $deskripsi = $request->deskripsi ?? '-';

        $safeNama = Str::slug($request->nama, ' ');
        $safeReg = Str::slug($request->reg_no, '');
        $safeTanggal = str_replace([':', ' '], '-', $tanggal);

        $random = Str::upper(Str::random(5));

        $fileName = $safeReg . ' - ' . $safeNama . ' - ' . $safeTanggal . ' - ' . $random . '.jpg';

        $path = null;

        if ($request->foto) {
            $image = str_replace('data:image/jpeg;base64,', '', $request->foto);
            $image = str_replace(' ', '+', $image);

            $path = 'mcu/' . $fileName;

            Storage::disk('public')->put($path, base64_decode($image));
        }

        Image::create([
            'no_mr' => $request->no_mr,
            'reg_no' => $request->reg_no,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tgl_lahir,
            'tanggal_pendaftaran' => $tanggal,
            'pekerjaan' => $pekerjaan,
            'deskripsi' => $deskripsi,
            'file_path' => $path,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Data berhasil disimpan!');
    }

}