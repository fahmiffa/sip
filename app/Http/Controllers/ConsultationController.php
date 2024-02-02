<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\Role;
use App\Models\User;
use Mail;
use App\Mail\SipMail;

class ConsultationController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsPermission:master_formulir');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Consultation::all();
        $data = "Konsultasi";
        return view('konsultasi.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "Tambah Konsultasi";
        $doc  = head::where('grant',1)->latest()->get();
        $user = Role::whereIn('kode',['TPT', 'TPA'])->get();       
        return view('konsultasi.create',compact('data','user','doc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [                   
            'doc' => 'required',           
            'konsultan'=> 'required',                                           
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        if(count($request->konsultan) > 2)
        {
            toastr()->error('konsultan maksimal 2', ['timeOut' => 5000]);
            return back();
        }

        $kons = new Consultation;
        $kons->head = $request->doc;
        $kons->konsultan = implode(",",$request->konsultan);              
        $kons->save();

        $this->mail($request->konsultan,$kons->head);

        toastr()->success('Tambah Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('consultation.index');
    }

    private function mail($var,$head)
    {
        $doc  = head::where('id',$head)->first();

        $header = json_decode($doc->header);

        foreach ($var as  $value) {
            $user = User::where('id',$value)->first();

            $mailData = [
                'title' => 'Yth. '.$user->name,
                'body' => 'Anda mendapatkan tugas untuk melakukan verifikasi terhadap permohonan PBG/SLF dengan Nomor Registrasi :'.$header[0]
            ];

            Mail::to($user->email)->send(new SipMail($mailData));
        }

         
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $data = "Edit Konsultasi";
        $doc  = head::where('grant',1)->latest()->get();
        $user = Role::whereIn('kode',['TPT', 'TPA'])->get();       
        return view('konsultasi.create',compact('data','user','doc','consultation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $rule = [                   
            'doc' => 'required',           
            'konsultan'=> 'required',                                           
            ];
        $message = ['required'=>'Field ini harus diisi'];
        $request->validate($rule,$message);

        if(count($request->konsultan) > 2)
        {
            toastr()->error('konsultan maksimal 2', ['timeOut' => 5000]);
            return back();
        }

        $kons = $consultation;
        $kons->head = $request->doc;
        $kons->konsultan = implode(",",$request->konsultan);              
        $kons->save();

        toastr()->success('Update Data berhasil', ['timeOut' => 5000]);
        return redirect()->route('consultation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
