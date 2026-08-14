<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\View\View;

class TentangController extends Controller
{
    public function index(): View
    {
        $setting = Pengaturan::getSetting();

        return view('tentang.index', compact('setting'));
    }
}
