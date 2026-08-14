<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Testimoni;
use Illuminate\View\View;

class TestimoniController extends Controller
{
    public function index(): View
    {
        $setting   = Pengaturan::getSetting();
        $testimonis = Testimoni::aktif()->get();

        return view('testimoni.index', compact('setting', 'testimonis'));
    }
}
