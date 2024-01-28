<?php 
use App\Models\Value;
use Intervention\Image\Facades\Image as Image;
use App\Models\Formulir;
use Carbon\Carbon;

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

function gambar($val)
{
    $imagePath = public_path($val); // Replace with your image path
    $imageData = Image::make($imagePath)->encode('data-url')->encoded;
    return $imageData;
}

function nomor($nextNumber)
{
    return str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
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