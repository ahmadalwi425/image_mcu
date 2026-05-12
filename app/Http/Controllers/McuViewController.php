<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Image;

class McuViewController extends Controller
{
    // LIST DATA
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $data = Image::whereDate('tanggal_pendaftaran', $tanggal)
            ->orderBy('id', 'desc')
            ->get();

        return view('mcu.index', compact('data', 'tanggal'));
    }

    // DETAIL FOTO
    public function show($id)
    {
        $item = Image::findOrFail($id);

        return view('mcu.show', compact('item'));
    }
}