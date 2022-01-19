<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $request -> validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            $user = Auth::user();
            Session::put('id_user', $user['id']);
            Session::put('name_user', $user['name']);

            return redirect('/dashboard');
        }
        return redirect('/login');
      
    }


    public function facebookRedirect()
    {  
        return Socialite::driver('facebook')->redirect();  
    }

    public function loginWithFacebook()
    {

        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);
    
                Auth::login($createUser);
                return redirect('/dashboard');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
