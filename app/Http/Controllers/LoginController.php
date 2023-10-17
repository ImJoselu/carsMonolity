<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('Forms.login');
    }

    public function login(Request $request)
    {
        try {
            //code...

            $request->validate([
                'correo-electronico' => 'required',
                'password' => 'required|min:3'
            ]);

            $correo = $request->input("correo-electronico");
            $password = $request->input("password");
            $usuario = Usuario::where("correo_electronico", $correo)
                ->where("password", $password)->firstOrFail();

            session(['usuario' => $usuario]);

            return redirect("/");
        } catch (\Throwable $th) {
            //throw $th;
            return view('errors.deleted_account');
        }
    }

    public function logout(Request $request)
    {
        try {
            //code...
            $request->session()->forget('usuario');

            return redirect("/");
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
