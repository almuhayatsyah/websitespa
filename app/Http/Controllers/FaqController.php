<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Pengaturan;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $setting = Pengaturan::getSetting();
        $faqs    = Faq::aktif()->get();

        return view('faq.index', compact('setting', 'faqs'));
    }
}
