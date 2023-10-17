<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marcas = Marca::latest()->get();
        return view('marcas.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (session('usuario')) {
            # code...
            if (session('usuario')->es_admin) {
                # code...
                return view('Marca.registroMarca');
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
        {
            if (session('usuario')) {
                # code...
                if (session('usuario')->es_admin) {
                    # code...
                    $request->validate([
                        'nombre' => 'required|min:3|max:12|unique:marcas,nombre',
                    ]);

                    $marca = new Marca();
                    $marca->nombre = $request->input("nombre");
                    $marca->save();

                    return redirect("/");
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
        $marca = Marca::find($marca);
        return view('marcas.show', ['marcas' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        //
    }
}
