<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;
use App\Models\Tiket;
use Illuminate\Support\Facades\Session;

class TiketsController extends Controller
{
    public function tiketsaya()
    {
        $user = Auth::user();
        $tikets = $user->tikets()->orderBy('id', 'desc')->paginate(10);

        return view('user.tiketsaya', compact('tikets'));
    }
    public function create()
    {
        $divisiOption = Divisi::all();

        return view('user.ajukan')->with('divisiOptions', $divisiOption);

    }
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('pengaju', $request->pengaju);
        Session::flash('aplikasi', $request->aplikasi);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('divisi_id', $request->divisi_id);


        $data = [
            'judul' => $request->judul,
            'pengaju' => $request->pengaju,
            'aplikasi' => $request->aplikasi,
            'deskripsi' => $request->deskripsi,
            'prioritas_id' => 4, // notset
            'status_id' => 1,
            'divisi_id' => $request->divisi_id,
            'user_id' => Auth::user()->id,
        ];

        try {
            Tiket::create($data);
            return redirect()->route('user.tiketsaya')->with('success', 'Tiket berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan tiket " . $e->getMessage());
        }
    }
    public function show($id)
    {
        $tiket = Tiket::with('prioritas', 'status', 'user', 'balasan')->find($id);

        if (!$tiket) {
            return redirect()->back()->with('error', 'Ticket not found');
        }

        return view('user.show', compact('tiket'));
    }
}
