<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pengaturan;
use Illuminate\View\View;

class LayananController extends Controller
{
    public function index(): View
    {
        $setting  = Pengaturan::getSetting();
        $layanans = Layanan::aktif()->get();

        return view('layanan.index', compact('setting', 'layanans'));
    }
}
