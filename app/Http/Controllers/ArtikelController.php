<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pengaturan;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(): View
    {
        $setting  = Pengaturan::getSetting();
        $artikels = Artikel::diterbitkan()->paginate(9);

        return view('artikel.index', compact('setting', 'artikels'));
    }

    public function show(Artikel $artikel): View
    {
        $setting = Pengaturan::getSetting();

        // Ensure only published articles are accessible
        if (! $artikel->diterbitkan) {
            abort(404);
        }

        return view('artikel.show', compact('setting', 'artikel'));
    }
}
