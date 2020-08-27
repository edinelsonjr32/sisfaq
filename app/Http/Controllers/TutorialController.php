<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Cliente;
use App\SubCategoria;
use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutoriais = DB::table('tutorial')->select('tutorial.*', 'sub_categoria.nome as nomeSubCategoria', 'cliente.nome as nomeCliente', 'categoria.nome as nomeCategoria')->join('cliente', 'cliente.id', 'tutorial.cliente_id')->join('sub_categoria', 'sub_categoria.id', 'tutorial.sub_categoria_id')->join('categoria', 'categoria.id', 'sub_categoria.categoria_id')->where('tutorial.deleted_at', '=', null)->get();

        $categorias = Categoria::all();
        $clientes = Cliente::all();
        return view('tutoriais.index', ['tutoriais' => $tutoriais, 'categorias' => $categorias, 'clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function primeiraParte(Request $request)
    {

        $titulo = $request->nome;
        $categoria = Categoria::findOrFail($request->categoria_id);
        $cliente = Cliente::findOrFail($request->cliente_id);


        $sub_categoria = SubCategoria::where('sub_categoria.categoria_id', $request->categoria_id)->get();

        return view('tutoriais.primeira_parte', ['titulo'=> $titulo, 'categoria'=> $categoria, 'cliente'=> $cliente, 'sub_categoria'=>  $sub_categoria]);
    }

    public function store(Request $request, Tutorial $tutorial)
    {
        $tutorial->sub_categoria_id = $request->sub_categoria_id;
        $tutorial->cliente_id = $request->cliente_id;
        $tutorial->titulo = $request->titulo;
        $tutorial->status = true;
        $tutorial->passo_numero = $request->passo_numero;
        $tutorial->link_video = $request->link_video;
        $tutorial->observacao = $request->observacao;
        $tutorial->path_foto = $request->path_foto;
        $path_foto = $request->file('path_foto');

        if ($path_foto = $request->file('path_foto')) {


            $files = $request->path_foto;




            $extensao = $files->getClientOriginalExtension();


            $imageName = time() . '.' . $extensao;
            $tutorial->path_foto = $imageName;
            $request->path_foto->move(public_path('images'), $imageName);

            if ($tutorial->save() ) {
                return redirect()->route('tutorial.index');
            }else{
                return redirect()->route('tutorial.index');
            }

        } else {
            if ($tutorial->save()) {
                return redirect()->route('tutorial.index');
            } else {
                return redirect()->route('tutorial.index');
            }
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutorial = DB::table('tutorial')->select('tutorial.*', 'sub_categoria.nome as nomeSubCategoria', 'categoria.nome as nomeCategoria', 'cliente.nome as nomeCliente')->join('sub_categoria', 'sub_categoria.id', '=', 'tutorial.sub_categoria_id')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', '=', 'tutorial.cliente_id')->where('tutorial.id', '=', $id)->get();

        return view('tutoriais.show', ['tutorial'=>$tutorial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutorial $tutorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        //
    }
}
