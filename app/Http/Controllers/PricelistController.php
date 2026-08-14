<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;

class PricelistController extends Controller
{
    public function index()
    {
        $pricelists = Pricelist::aktif()->get();
        $kategoris  = $pricelists->pluck('kategori')->unique()->values();

        return view('pricelist.index', compact('pricelists', 'kategoris'));
    }
}
