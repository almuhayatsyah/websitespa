<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pengaturan;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        $setting  = Pengaturan::getSetting();
        $layanans = Layanan::aktif()->take(3)->get();

        return view('beranda', compact('setting', 'layanans'));
    }
}
