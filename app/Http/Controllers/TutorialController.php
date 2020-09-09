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

        return view('tutoriais.primeira_parte', ['titulo'=> $titulo, 'categoria'=> $categoria, 'categoria_id'=> $request->categoria_id, 'cliente_id'=>$request->cliente_id, 'nome'=> $request->nome, 'cliente'=> $cliente, 'sub_categoria'=>  $sub_categoria]);
    }

    public function primeiraParteSubCategoria(Request $request)
    {

        $request->validate([
            'nomeSubCategoria' => 'required'
        ]);
        $subCategoria = new SubCategoria;
        $subCategoria->nome = $request->nomeSubCategoria;
        $subCategoria->categoria_id = $request->categoria_id;

        $subCategoria->save();


        $titulo = $request->nome;
        $categoria = Categoria::findOrFail($request->categoria_id);
        $cliente = Cliente::findOrFail($request->cliente_id);

        $sub_categoria = SubCategoria::where('sub_categoria.categoria_id', $request->categoria_id)->get();

        return view('tutoriais.primeira_parte', ['titulo' => $titulo, 'categoria' => $categoria, 'categoria_id' => $request->categoria_id, 'cliente_id' => $request->cliente_id, 'nome' => $request->nome, 'cliente' => $cliente, 'sub_categoria' =>  $sub_categoria]);
    }
    public function store(Request $request, Tutorial $tutorial)
    {

        $tutorial->sub_categoria_id = $request->sub_categoria_id;
        $tutorial->cliente_id = $request->cliente_id;
        $tutorial->titulo = $request->titulo;
        $tutorial->status = true;
        $tutorial->passo_numero = $request->passo_numero;
        parse_str(parse_url($request->link_video, PHP_URL_QUERY), $array);

        $tutorial->observacao = $request->observacao;
        if ($request->link_video == null) {

        }else{


            $tutorial->link_video = '<iframe width="100%" height="720" src="https://www.youtube.com/embed/' . $array['v'] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }

        $tutorial->path_foto = $request->path_foto;
        $path_foto = $request->file('path_foto');

        if ($path_foto = $request->file('path_foto')) {

            $files = $request->path_foto;
            $extensao = $files->getClientOriginalExtension();
            $imageName = time() . '.' . $extensao;
            $tutorial->path_foto = $imageName;
            $request->path_foto->move(public_path('images'), $imageName);
            if ($tutorial->save() ) {
                return redirect()->route('sub_categoria.show', $tutorial->sub_categoria_id);
            }else{
                return redirect()->route('cliente.show', $tutorial->cliente_id);
            }

        } else {
            if ($tutorial->save()) {
                return redirect()->route('sub_categoria.show', $tutorial->sub_categoria_id);
            } else {
                return redirect()->route('cliente.show', $tutorial->cliente_id);
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
        $tutorial = DB::table('tutorial')->select('tutorial.*', 'sub_categoria.nome as nomeSubCategoria', 'categoria.nome as nomeCategoria', 'cliente.nome as nomeCliente')->join('sub_categoria', 'sub_categoria.id', '=', 'tutorial.sub_categoria_id')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', '=', 'tutorial.cliente_id')->where('tutorial.id', '=', $id)->where('tutorial.deleted_at', '=', null)->get();


        return view('tutoriais.show', ['tutorial'=>$tutorial]);
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filenametostore);
            $msg = 'Imagem Adicionada com Sucesso';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutorial = Tutorial::findOrFail($id);

        $subCategoriaId = $tutorial->sub_categoria_id;



        $categoria = DB::table('categoria')->select('categoria.id')->join('sub_categoria', 'sub_categoria.categoria_id', 'categoria.id')->where('sub_categoria.id', '=', $id)->value('categoria_id');

        $sub_categoria = DB::table('sub_categoria')->select('sub_categoria.*')->where('sub_categoria.categoria_id', '=', $categoria)->get();

        return view('tutoriais.edit', ['sub_categoria'=> $sub_categoria, 'id' => $id, 'subCategoriaId'=> $subCategoriaId, 'tutorial'=>$tutorial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::findOrFail($id);

        $tutorial->update($request->all());

        $idSubCategoria = $tutorial->sub_categoria_id;

        parse_str(parse_url($request->link_video, PHP_URL_QUERY), $array);

        $tutorial->observacao = $request->observacao;
        if ($request->link_video == null) {

        }else{


            $tutorial->link_video = '<iframe width="100%" height="720" src="https://www.youtube.com/embed/' . $array['v'] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }

        $tutorial->update();

        return redirect()->route('sub_categoria.show', $idSubCategoria);
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
    public function excluir($id)
    {

        $tutorial = Tutorial::find($id);


        $idSUbCategoria = $tutorial->sub_categoria_id;

        if ($tutorial->delete()) {
            return redirect()->route('sub_categoria.show', $idSUbCategoria);
        }
    }
}
