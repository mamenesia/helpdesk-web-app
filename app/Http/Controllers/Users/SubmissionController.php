<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class SubmissionController extends Controller
{
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

        return view('planner.tampilkansubmission', compact('submission'));
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
    public function tampilkanSubmissionUser($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found');
        }

        return view('user.tampilkansubmission', compact('submission'));
    }
}
