<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Prioritas;
use App\Models\Divisi;
use App\Models\File;
use App\Models\Reply;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $query = Tiket::orderBy('id', 'asc');

        if ($request->has('search_filter') && $request->input('search_filter') != '') {
            $search_filter = $request->input('search_filter');
            $query->where(function ($query) use ($search_filter) {
                $query->where('judul', 'LIKE', '%' . $search_filter . '%')
                    ->orWhere('pengaju', 'LIKE', '%' . $search_filter . '%')
                    ->orWhere('aplikasi', 'LIKE', '%' . $search_filter . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search_filter . '%')
                    ->orWhere('user_id', 'LIKE', '%' . $search_filter . '%')
                    ->orWhere('agent_id', 'LIKE', '%' . $search_filter . '%');
            })
                ->orWhereHas('status', function ($query) use ($search_filter) {
                    $query->where('nama_status', 'LIKE', '%' . $search_filter . '%');
                })
                ->orWhereHas('prioritas', function ($query) use ($search_filter) {
                    $query->where('nama_prioritas', 'LIKE', '%' . $search_filter . '%');
                })
                ->orWhereHas('divisi', function ($query) use ($search_filter) {
                    $query->where('nama_divisi', 'LIKE', '%' . $search_filter . '%');
                });

        }

        if ($request->has('date') && $request->input('date') != '') {
            $date = $request->input('date');
            $query->whereDate('tiket.created_at', '=', $date);
        }

        if ($request->has('prioritas')) {
            $prioritas_filter = $request->input('prioritas');
            if ($prioritas_filter != 'all') {
                $query->whereHas('prioritas', function ($query) use ($prioritas_filter) {
                    $query->where('nama_prioritas', $prioritas_filter);
                });
            }
        }

        if ($request->has('status')) {
            $status_filter = $request->input('status');
            if ($status_filter != 'all') {
                $query->whereHas('status', function ($query) use ($status_filter) {
                    $query->where('nama_status', $status_filter);
                });
            }
        }

        // Execute the query and paginate the results
        $data = $query->join('prioritas', 'tiket.prioritas_id', '=', 'prioritas.id')
            ->join('status', 'tiket.status_id', '=', 'status.id')
            ->select('tiket.*', 'prioritas.nama_prioritas', 'status.nama_status')
            ->paginate(10);

        $data->append($request->all());

        return view('tiket.daftar', compact('data'));
    }

    public function create()
    {
        $prioritasOptions = Prioritas::all();
        $divisiOptions = Divisi::all();

        return view('tiket.ajukan')->with('prioritasOptions', $prioritasOptions)->with('divisiOptions', $divisiOptions);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('pengaju', $request->pengaju);
        Session::flash('aplikasi', $request->aplikasi);
        Session::flash('prioritas_id', $request->prioritas_id);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('divisi_id', $request->divisi_id);


        $data = [
            'judul' => $request->judul,
            'pengaju' => $request->pengaju,
            'aplikasi' => $request->aplikasi,
            'prioritas_id' => $request->prioritas_id,
            'deskripsi' => $request->deskripsi,
            'status_id' => 1,
            'divisi_id' => $request->divisi_id,
            'user_id' => Auth::user()->id,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('files/' . $filename);
            $file->move($location);

            $fileData = [
                'uuid' => Str::uuid(),
                'nama_file' => $filename,
                'nama_server' => md5($file->getRealPath()) . '.' . $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'path' => $location,
                'extension' => Str::lower($file->getClientOriginalExtension()),
                'disk' => 'public',
                'user_id' => '1', // assuming the user is authenticated
            ];
            File::create($fileData);
        }

        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $nama_file = $file->getClientOriginalName();

        //     $photo = new File();
        //     $photo->uuid = Str::uuid();
        //     $photo->nama_file = $nama_file;
        //     $photo->nama_server = md5($file->getRealPath() . time()) . '.' . $file->getClientOriginalExtension();
        //     $photo->size = $file->getSize();
        //     $photo->mime = $file->getMimeType();
        //     $photo->path = date('Y') . '/' . date('m');
        //     $photo->extension = Str::lower($file->getClientOriginalExtension());
        //     $photo->disk = 'public';
        //     $photo->user_id = '1'; // assuming the user is authenticated
        //     $photo->save();
        // }

        // $fileData = [
        //     'uuid' => Str::uuid(),
        //     'nama_file' => $file->getClientOriginalName(),
        //     'nama_server' => md5($file->getRealPath()) . '.' . $file->getClientOriginalExtension(),
        //     'size' => $file->getSize(),
        //     'mime' => $file->getMimeType(),
        //     'path' => date('Y') . '/' . date('m'),
        //     'extension' => $file->getClientOriginalExtension(),
        //     'disk' => 'public',
        //     'user_id' => '1', // assuming the user is authenticated
        // ];

        // // Create the file record in the files table
        // File::create($fileData);

        try {
            Tiket::create($data);
            return redirect()->route('tiket.daftar')->with('success', 'Tiket berhasil ditambahkan');
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

        return view('tiket.show', compact('tiket'));
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
            return redirect()->route('tiket.show', $request->tiket_id)->with('success', 'Balasan berhasil ditambahkan');
        } catch (\Exception $e) {
            return ("Gagal menambahkan balasan " . $e->getMessage());
        }
    }

    public function close($id)
    {
        $tiket = Tiket::find($id);
        if (!$tiket) {
            return redirect()->back()->with('error', 'Ticket not found');
        }

        $tiket->status_id = 3;
        $tiket->closed_by = Auth::user()->id;
        $tiket->closed_at = now();
        $tiket->save();

        return redirect()->back()->with('success', 'Ticket closed');
    }
}
