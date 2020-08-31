<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();


        return view('clientes.index', ['clientes' => $clientes]);
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
    public function store(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required',
            'dominio' => 'required',
            'versao' => 'required',
        ]);

        $link = substr(md5(mt_Rand()), 0, 15);

        $cliente->nome = $request->nome;
        $cliente->dominio = $request->dominio;
        $cliente->versao = $request->versao;
        $cliente->link_acesso = $link;

        if ($cliente->save()) {
            return redirect()->route('cliente.index')->with(['success', 'Dados adicionados com sucesso!']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {

        $idCliente = $cliente->id;
        $categorias = DB::table('categoria')->select('categoria.*')->join('cliente', 'cliente.id', 'categoria.cliente_id')->where('cliente.id', '=',  $cliente->id)->where('categoria.deleted_at', null)->get();

        $sub_categorias = DB::table('sub_categoria')->select('sub_categoria.*', 'categoria.nome as nomeCategoria')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('sub_categoria.deleted_at',null)->where('cliente.id', '=',  $cliente->id)->get();

        return view('clientes.show', compact('cliente', 'categorias', 'sub_categorias', 'idCliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'dominio' => 'required',
            'versao' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->nome = $request->nome;
        $cliente->dominio = $request->dominio;
        $cliente->versao = $request->versao;
        if ($cliente->update()) {
            return redirect()->route('cliente.index')->with(['success', 'Dados adicionados com sucesso!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente->delete()) {
            return redirect()->route('cliente.index');
        }
    }
}
