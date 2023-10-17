<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::latest()->get();
        return view('User.listarUsuarios', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('Forms.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'edad' => 'required|numeric|min:18',
            'nif' => 'required|min:9|max:9|unique:usuarios,nif',
            'correo-electronico' => 'required|unique:usuarios,correo_electronico',
            'password' => 'required|min:3|max:12'
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->edad = $request->input("edad");
        $usuario->nif = $request->input("nif");
        $usuario->correo_electronico = $request->input("correo-electronico");
        $usuario->password = $request->input("password");
        $ruta = $request->file('imagen')->store('/public/imagenes');
        $ruta = str_replace('public', '/storage', $ruta);
        $usuario->ruta_img = $ruta;
        $usuario->save();

        session(['usuario' => $usuario]);
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //

        if (session('usuario')) {
            $cochesUsuario = Coche::where('usuario_id', $usuario->id)->get();
            return view('User.visualizarUser', compact('usuario', 'cochesUsuario'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                return view('User.editarUser', ['usuario' => $usuario]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                try {
                    //code...
                    //
                    $request->validate([
                        'nombre' => 'required',
                        'edad' => 'required|numeric|min:18',
                        'nif' => 'required|min:9|max:9|unique:usuarios,nif',
                        'correo-electronico' => 'required|unique:usuarios,correo_electronico',
                        'password' => 'required|min:3|max:12'
                    ]);

                    $usuario = Usuario::find($usuario)[0];

                    $usuario->nombre = $request->input('nombre');
                    $usuario->edad = $request->input('edad');
                    $usuario->nif = $request->input("nif");
                    $usuario->correo_electronico = $request->input("correo-electronico");
                    $usuario->password = $request->input("password");
                    $usuario->save();

                    return redirect('/usuarios');
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($th);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                $usuario->delete();

                return redirect('/usuarios');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }


    public function checkEmailExists(Request $request)
    {
        $correo = $request->input("correoElectronico");
        $usuario = Usuario::where('correo_electronico', $correo)->exists();
        $existe = $usuario ? 'true' : 'false';

        return $existe;
    }

    public function eliminados()
    {
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                $usuarios = Usuario::withTrashed()->get();
                return view('User.listarUsuariosEliminados', ['usuarios' => $usuarios]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function restaurarUsuario($id)
    {
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                $usuario = Usuario::withTrashed()->find($id);
                if ($usuario->trashed()) {
                    $usuario->restore();
                }
                return redirect('/usuarios');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function panelAdmin() {
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                return view('Admin.panelAdministracion');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
