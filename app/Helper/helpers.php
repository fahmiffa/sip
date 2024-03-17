<?php 
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;
use App\Models\Head;
use App\Models\Title;
use App\Models\Item;
use App\Models\Sub;

function headers($id,$index,$val)
{ 
    $da = Formulir::findOrFail($id);
    $va = json_decode($da->items);
    if($va->$index)
    {
        $res = $va->$index;
        return $res[$val];
    }
    else
    {
        return 'None';
    }
}

function named($val,$par)
{
    if($par == 'item')
    {
        return Item::where('id',$val)->first()->name;
    }

    if($par == 'sub')
    {
        return Sub::where('id',$val)->first()->name;
    }
}

function items($id,$index,$val)
{
    $da = Formulir::findOrFail($id);
    $va = json_decode($da->items);
    if($va->$index)
    {
        return $va->$index->$val;        
    }
    else
    {
        return 'None';
    }
}

function doc($val, $type)
{
    if($type == 'umum')
    {
        if($val == 5)
        {
            return 'Dokumen Administrasi';
        }
        else if($val == 4)
        {
            return 'Dokumen Teknis';
        }
        else if($val == 3)
        {
            return 'Dokumen Pendukung Lainnya (Untuk SLF)';
        }
    }
    else
    {
        if($val == 5)
        {
            return 'Dokumen Administrasi';
        }
        if($val == 4)
        {
            return 'Persyaratan Teknis';
        }

    }
}


function status($val)
{
    if($val == '0')
    {
        return 'Tidak Ada';
    }
    else if($val == '1')
    {
        return 'Ada';
    }
    else if($val == '2')
    {
        return 'TIdak Perlu';
    }
    else
    {
        return 'Unknown';
    }
}

function gambar($val)
{
    $imagePath = public_path($val); // Replace with your image path
    $imageData = Image::make($imagePath)->encode('data-url')->encoded;
    return $imageData;
}

function nomor()
{
    $num = Head::get()->count();               
    $nom = str_pad($num, 4, '0', STR_PAD_LEFT);
    return '600.1.15/'.$nom.'/SPm-SIMBG/'.numberToRoman(date('m')).'/'.date('Y');
}

function baseDoc()
{
    return ['menara','umum'];
}

function Abjad($index)
{
    $abjad = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    return $abjad[$index];
}

function numberToRoman($number)
{
    $romans = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );

    $result = '';

    foreach ($romans as $roman => $value) {
        $matches = intval($number / $value);
        $result .= str_repeat($roman, $matches);
        $number = $number % $value;
    }

    return $result;
}

function dateID($par)
{
    $date = Carbon::parse($par);
    $date->setLocale('id');
    $indonesianDate = $date->isoFormat('LL'); 
    return $indonesianDate;
}

function Hari($tanggal) {
    $date = Carbon::parse($tanggal)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);    
    return $date->format('l, j F Y'); 
}