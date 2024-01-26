<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::orderBy('id', 'asc');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('nipp', 'LIKE', '%' . $search . '%')
                    ->orWhere('nomor_hp', 'LIKE', '%' . $search . '%');
            })
                ->orWhereHas('divisi', function ($query) use ($search) {
                    $query->where('nama_divisi', 'LIKE', '%' . $search . '%');
                });

        }

        $users = $query->paginate(10);

        return view('user', compact('users'));
    }

}
