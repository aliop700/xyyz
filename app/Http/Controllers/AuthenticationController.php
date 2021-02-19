<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Actions\GetRedirectAction;
use App\Consts\Roles;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginPage(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
            'password'  => 'required'
        ])->validate();

        // if($validator->fails()) {
        //     return response()->fail($validator->errors(), 422);
        // }

        $data = $request->only('email','password');

        if(!Auth::attempt($data)) {
            // return response()->fail('credentials are not correct', 404);
            return redirect()->back()->withInput($request->only('email', 'password'))->withErrors([
                'approve' => 'Incorrect username or password',
            ]);
        }

        $user = User::where('email', $request->email)->first();

        Auth::login($user);

        $redirect = (new GetRedirectAction)($user);

        return redirect($redirect);

    }

    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' =>  'required|email|unique:users',
            'password'  => 'required|confirmed',
            'name'  =>'required',
            'phone' =>  'required',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required',
        ])->validate();
     

        
        
        $validated['role_id'] = Roles::ADMIN;

        $user = User::create($validated);
        
        Auth::login($user);

        $redirect = (new GetRedirectAction)($user);

        return redirect($redirect);
    }

    public function logout(Request $request)
    {
        
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    public function registerPage(Request $request)
    {
        return view('auth.register');
    }
}
