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
use App\Models\File;
use App\Models\User;
use App\Notifications\TicketReplyReceived;
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
            $path = $file->store('public/uploads');
            $extension = $file->getClientOriginalExtension();
            $disk = 'local';

            // Store the file information in the database
            $fileData = [
                'uuid' => (string) Str::uuid(),
                'nama_file' => $originalName,
                'nama_server' => $serverName,
                'size' => $size,
                'mime' => $mime,
                'path' => $path,
                'extension' => $extension,
                'disk' => $disk,
                'user_id' => Auth::user()->id,
            ];
            $fileRecord = File::create($fileData);
            $data['file_id'] = $fileRecord->id;
        }

        $user = Auth::user();
        $data['ticket_id'] = Tiket::generateTicketId($user);

        try {
            Tiket::create($data);
            return redirect()->route('user.tiketsaya')->with('success', 'Tiket berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan tiket " . $e->getMessage());
        }
    }

    public function tampilkan($id)
    {
        $tiket = Tiket::with('prioritas', 'status', 'user', 'balasan', 'files')->find($id);

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

        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');
            $originalName = $file->getClientOriginalName();
            $serverName = $file->hashName();
            $size = $file->getSize();
            $mime = $file->getMimeType();
            $path = $file->store('public/uploads');
            $extension = $file->getClientOriginalExtension();
            $disk = 'local';

            // Store the file information in the database

            $fileData = [
                'uuid' => (string) Str::uuid(),
                'nama_file' => $originalName,
                'nama_server' => $serverName,
                'size' => $size,
                'mime' => $mime,
                'path' => $path,
                'extension' => $extension,
                'disk' => $disk,
                'user_id' => Auth::user()->id,
            ];

            $fileRecord = File::create($fileData);
            $data['file_id'] = $fileRecord->id;

        }
        try {
            $reply = Reply::create($data);
            $user = User::find($request->user_id);
            $user->notify(new TicketReplyReceived($reply));
            return redirect()->route('user.tampilkan', $request->tiket_id)->with('success', 'Balasan berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan balasan " . $e->getMessage());
        }
    }
}
