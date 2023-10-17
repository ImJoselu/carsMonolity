<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Marca;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CocheController extends Controller
{
    public function welcome()
    {
        $coches = Coche::paginate(6);
        $marcas = Marca::all();
        return view('index', compact('coches', 'marcas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $coches = Coche::paginate(6);
        $marcas = Marca::all();
        return view('index', compact('coches', 'marcas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
        $marcas = Marca::all();

        if (session('usuario')) {

            # code...
            if (session('usuario')->es_admin) {

                # code...
                return view('Coche.registroCoche', compact('marcas'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        if (session('usuario')) {

            $request->validate([

                'matricula' => 'required|string',
                'modelo' => 'required|string',
                'color' => 'required|string',
                'motor' => 'required|string',
                'marca_id' => 'exists:marcas,id',
                'ruta_img' => 'mimes:jpeg,png,jpg,bmp',

            ]);

            $coche = new Coche();
            $coche->matricula = $request->input("matricula");
            $coche->modelo = $request->input("modelo");
            $coche->color = $request->input("color");
            $coche->motor = $request->input("motor");
            $coche->marca_id = $request->marca;
            $ruta = $request->file('imagen')->store('/public/imagenes');
            $ruta = str_replace('public', '/storage', $ruta);
            $coche->ruta_img = $ruta;



            $coche->save();

            return redirect("/");
        } else {
            abort(404);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function show(Coche $coche)
    {
        //
        $marcas = Marca::all();
        return view('Coche.visualizarCoche', ['coche' => $coche], compact('marcas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function edit(Coche $coche)
    {
        //

        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                # code...

                $marcas = Marca::all();
                return view('Coche.editarCoche', compact('coche', 'marcas'));
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
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coche $coche)
    {
        if (session('usuario') && session('usuario')->es_admin) {
            try {
                $request->validate([
                    'matricula' => 'required|min:7|max:7|unique:coches,matricula,' . $coche->id . ',id',
                    'modelo' => 'required',
                    'color' => 'required',
                    'motor' => 'required',
                    'marca_id' => 'exists:marcas,id',
                    'imagen' => 'mimes:jpeg,png,jpg,bmp',
                ]);

                $coche->matricula = $request->input('matricula');
                $coche->modelo = $request->input('modelo');
                $coche->color = $request->input('color');
                $coche->motor = $request->input('motor');
                $coche->marca_id = $request->input('marca');

                if ($request->hasFile('imagen')) {
                    $ruta = $request->file('imagen')->store('public/imagenes');
                    $coche->ruta_img = Storage::url($ruta);
                }

                $coche->save();

                return redirect('/');
            } catch (\Throwable $th) {
                dd($th);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coche $coche)
    {
        //
        //
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                # code...
                $coche->delete();

                return redirect('/');
            }
            abort(404);
        }
        abort(404);
    }

    public function comprar(Request $request, $coche)
    {
        $coche = Coche::find($coche);
        $coche->usuario_id = session('usuario')->id;
        $coche->save();

        return redirect('/');
    }

    public function filtro(Request $request)
    {
        $marcas = Marca::all();

        $coches = Coche::query();

        if ($request->has('marca') && $request->input('marca') !== '' && $request->input('marca') > 0 && !$request->input('estado')) {
            $coches->where('marca_id', $request->input('marca'));
            $coches = $coches->get();
            //  TODOS LOS COCHES
        } else if ($request->input('estado') == 0 && !$request->input('marca')) {
            $coches = Coche::paginate(6);
            // COCHES EN VENTA
        } else if ($request->input('estado') == 1 && !$request->input('marca')) {
            $coches->where('usuario_id', null)->where('marca_id', $request->input('marca'));
            $coches = $coches->get();
            // COCHES COMPRADOS
        } else if ($request->input('estado') == 2 && !$request->input('marca')) {
            $coches->where('usuario_id', '>=', 1);
            $coches = $coches->get();
            // LOS FILTROS ACTIVOS ( 2 )
        } else if ($request->input('estado') && $request->input('marca')) {
            if ($request->input('estado') == 0 && $request->input('marca') >= 1) {
                $coches->where('marca_id', '>=', $request->input('marca'));
                $coches = $coches->get();
            } else if ($request->input('estado') == 1 && $request->input('marca') >= 1) {
                $coches->where('marca_id', $request->input('marca'))->where('usuario_id', null);
                $coches = $coches->get();
            } else if ($request->input('estado') == 2 && $request->input('marca') >= 1) {
                $coches->where('marca_id', $request->input('marca'))->where('usuario_id', '>=', 1);
                $coches = $coches->get();
            } else {
                if ($request->input('estado') == 1) {
                    return 1;
                    $coches->where('usuario_id', null);
                    $coches = $coches->get();
                    // COCHES COMPRADOS
                } else if ($request->input('estado') == 2) {
                    return 2;
                    $coches->where('usuario_id', '>=', 1);
                    $coches = $coches->get();
                } else {
                    return 3;
                    $coches = Coche::paginate(6);
                }
            }
        }
        return view('index', compact('coches', 'marcas'));
    }
}
