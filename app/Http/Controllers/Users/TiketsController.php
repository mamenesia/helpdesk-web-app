<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;
use App\Models\Tiket;
use Illuminate\Support\Facades\Session;
use App\Models\Prioritas;
use App\Models\Reply;
use App\Models\Submission;
use App\Models\File;
use Illuminate\Support\Str;

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
        $prioritasOption = Prioritas::all();

        return view('user.ajukan')->with('divisiOptions', $divisiOption)->with('prioritasOptions', $prioritasOption);

    }
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('pengaju', $request->pengaju);
        Session::flash('aplikasi', $request->aplikasi);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('prioritas_id', $request->prioritas_id);
        Session::flash('divisi_id', $request->divisi_id);


        $data = [
            'judul' => $request->judul,
            'pengaju' => $request->pengaju,
            'aplikasi' => $request->aplikasi,
            'deskripsi' => $request->deskripsi,
            'prioritas_id' => $request->prioritas_id,
            'status_id' => 1,
            'divisi_id' => $request->divisi_id,
            'user_id' => Auth::user()->id,
        ];

        if ($request->hasFile('formFile')) {
            $file = $request->file('formFile');
            $originalName = $file->getClientOriginalName();
            $serverName = $file->hashName();
            $size = $file->getSize();
            $mime = $file->getMimeType();
            $path = $file->store('uploads');
            $extension = $file->getClientOriginalExtension();
            $disk = 'local'; // or whatever disk you're using

            // Store the file information in the database
            File::create([
                'uuid' => (string) Str::uuid(),
                'nama_file' => $originalName,
                'nama_server' => $serverName,
                'size' => $size,
                'mime' => $mime,
                'path' => $path,
                'extension' => $extension,
                'disk' => $disk,
                'user_id' => Auth::user()->id,
            ]);
        }

        try {
            Tiket::create($data);
            return redirect()->route('user.tiketsaya')->with('success', 'Tiket berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan tiket " . $e->getMessage());
        }
    }
    public function tampilkan($id)
    {
        $tiket = Tiket::with('prioritas', 'status', 'user', 'balasan')->find($id);

        if (!$tiket) {
            return redirect()->back()->with('error', 'Ticket not found');
        }

        return view('user.tampilkan', compact('tiket'));
    }
    public function reply(Request $request)
    {
        $data = [
            'tiket_id' => $request->tiket_id,
            'user_id' => $request->user_id,
            'balasan' => $request->balasan,
        ];

        try {
            Reply::create($data);
            return redirect()->route('user.tampilkan', $request->tiket_id)->with('success', 'Balasan berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan balasan " . $e->getMessage());
        }
    }
    public function createppkb()
    {
        return view('user.submission');

    }
    public function storeppkb(Request $request)
    {
        Session::flash('nomor_ppkb', $request->nomor_ppkb);
        Session::flash('ppkb_ke', $request->ppkb_ke);
        Session::flash('service_code', $request->service_code);
        Session::flash('nama_kapal', $request->nama_kapal);
        Session::flash('keagenan', $request->keagenan);
        Session::flash('status', $request->status);

        $data = [
            'nomor_ppkb' => $request->nomor_ppkb,
            'ppkb_ke' => $request->ppkb_ke,
            'service_code' => $request->service_code,
            'nama_kapal' => $request->nama_kapal,
            'keagenan' => $request->keagenan,
            'status' => 'New',
            'user_id' => Auth::user()->id,
        ];

        try {
            Submission::create($data);
            return redirect()->route('user.daftarsubmission')->with('success', 'Submission berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan tiket " . $e->getMessage());
        }

    }
    public function daftarsubmission()
    {
        $submission = Submission::orderBy('created_at', 'desc')->paginate(10);
        return view('user.daftarSubmission', compact('submission'));
    }
    public function tampilkansubmission($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found');
        }

        return view('user.tampilkansubmission', compact('submission'));
    }
    public function updatesubmission(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        if ($submission->status == "New") {
            $submission->status = $request->status;
            $submission->save();
        }

        return redirect()->route('user.tampilkansubmission', ['id' => $submission->id])->with('success', 'Submission berhasil diupdate');
    }

    public function selesai($id)
    {
        $submission = Submission::find($id);
        if (!$submission) {
            return redirect()->back()->with('error', 'Ticket not found');
        }

        $submission->status = "Done";
        $submission->closed_by = Auth::user()->id;
        $submission->closed_at = now();
        $submission->save();

        return redirect()->back()->with('success', 'Ticket closed');
    }
}
