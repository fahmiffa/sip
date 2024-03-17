<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use DB;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {                
        $data = 'Login';            
        return view('log',compact('data'));
    } 

    public function login()
    {                
        $data = 'Login';            
        return view('login',compact('data'));
    } 

    public function forgot()
    {
        $data = 'Halaman Lupa Password';            
        return view('forgot',compact('data'));
    }

    public function forget(Request $request)
    {             
        $rule = [                        
            'email'=>'required|exists:users,email',                       
            // 'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',         
            'captcha' => ['required','captcha'],   
            ];

        $messages   =   [                      
            'email.required'     =>  'Email harus di isi',                                                                                 
            'email.exists'       =>  'Email Tidak ada',   
            'captcha.required' => 'captcha required',
            'captcha.captcha' => 'captcha invalid',         
            // 'password.required'  =>  'Password harus di isi',         
            // 'password.regex'     =>  'Password harus kombinasi Huruf dan Angka'                                                                          
        ];

        $request->validate($rule,$messages);

        toastr()->success('Cek email untuk reset passwrod', ['timeOut' => 5000]);
        return back();        
    } 
    
    public function pforget(Request $request)
    {

            $messages   =   [                
                'email.required'       =>  'Email wajib diisikan',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'email' => 'required'                    
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $user = User::where('email',$request->email);
                $da = $user->exists();

                If($da)
                {
                    $random = $user->first()->id.Str::random(40);     
                    $now = Carbon::now();
                    $exp = Carbon::now()->addHour(env('EXP'));                           


                    $del = Forgot::where('user_id',$user->first()->id)->exists();
                    if($del)
                    {
                        $del->first()->delete();
                    }
                    

                    Forgot::create([
                        'user_id'=>$user->first()->id,
                        'exp'=>$exp,
                        'random'=>$random
                    ]);

                    $link = url('verif/'.$random);

                    SendEmail($request->email,config('notif.reset'),$link);
                    Alert::success('info', 'Send a link to reset your password, check email');
                    return back();
                }
                else
                {                 
                    Alert::error('error', 'Email not found');
                    return back();
                }

            }        
        
    }

    public function verif($id)
    {            

        try {
            $ids = substr($id,0,1);                
    
            $user = Forgot::where('user_id',$ids)->where('random',$id);
            $now = Carbon::now();

            if(!$user->exists())
            {
                throw new Exception("Link Forgot Password Invalid");
                
            }
    
            if($now > $user->first()->exp)
            {
                throw new Exception("Link Forgot Password expired");
            }                        

            $data = 'New Password';            
            $da = $user->first();
            return view('ver',compact('data','da'));                       
        } catch (Exception $e) {

            Alert::error('error', $e->getMessage());
            return redirect('forget');
            
        }

    } 
    
    public function pverif(Request $request, $id)
    {

            $messages   =   [                
                'password.required'       =>  'password wajib diisikan',
                'password.confirmed'       =>  'password confirm tidak sama',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'password' => 'required|confirmed'             
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $user = User::where('id',$id)->first();
                $da = $user->exists();
 
                If($da)
                {
                    $user->password = bcrypt($request->password);
                    $user->save();
                    Alert::success('info', 'Success Update Password');
                    return redirect('login');
                }
                else
                {                 
                    Alert::error('error', 'Invalid Update Password');
                    return redirect('login');
                }

            }        
        
    }


    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect()->route('login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function log(Request $request)
    {

            $messages   =   [
                'password.required'       =>  'Pasword wajib diisikan',
                'email.required'       =>  'Email wajib diisikan',
                'captcha.required' => 'captcha required',
                'captcha.captcha' => 'captcha invalid',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'email' => 'required',
                    'password' => 'required',     
                    'captcha' => ['required','captcha'],                  
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $credensil = $request->only('email','password');;

                if (Auth::attempt($credensil)) {
                    $user = Auth::user();                                          
                    return redirect()->route('main');  
                    
                }                                      
                toastr()->error('Akun tidak ditemukan', ['timeOut' => 5000]);
                return back();
            }        
        
    }
    

}
