<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::get()->all();

        return view('mahasiswa.index', compact('mahasiswas'));
    }
}
