<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('register');
  }
  public function store(Request $request)
  {
    $messages = [
      'name.required' => 'Nama harus diisi',
      'email.required' => 'Email harus diisi',
      'password.required' => 'Password harus diisi',
      'password.confirmed' => 'Password Konfirmasi harus cocok'
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required|confirmed'
    ], $messages)->validate();

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect('/');
  }
}
