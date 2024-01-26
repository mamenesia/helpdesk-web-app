<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::orderBy('id', 'asc')->paginate(10);

        return view('divisi', compact('divisi'));
    }
}
