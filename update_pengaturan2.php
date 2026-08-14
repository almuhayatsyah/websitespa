<?php

$pengaturan = \App\Models\Pengaturan::first();

if ($pengaturan) {
    $pengaturan->update([
        'nama_situs'     => 'Spa Kecantikan',
        'nama_perusahaan'=> 'Spa Kecantikan',
    ]);
    
    $seo = $pengaturan->meta_seo ?? [];
    $seo['author'] = 'Spa Kecantikan';
    $pengaturan->meta_seo = $seo;
    $pengaturan->save();
    
    echo "Updated successfully!\n";
} else {
    echo "Not found!\n";
}
