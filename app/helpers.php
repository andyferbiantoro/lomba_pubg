<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function uploads($file, $path)
{
    $fileName   = time() . $file->getClientOriginalName();
    Storage::disk('public')->put($path . $fileName, File::get($file));
    $filePath   = 'storage/'.$path . $fileName;

    return $fileName;
}

function tanggal_indonesia($tanggal)
{
	$bulan = [
		'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $var = explode('-', $tanggal);

    // var 0 = tanggal
    // var 1 = bulan
    // var 2 = tahun
    return $var[2] . ' ' . $bulan[ (int)$var[1] ] . ' ' . $var[0];
}

?>