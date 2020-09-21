<?php

namespace App\Http\Controllers;

use App\ItemTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {


        $itemTutorial = new ItemTutorial();
        parse_str(parse_url($request->link_video, PHP_URL_QUERY), $array);

        $itemTutorial->observacao = $request->observacao;
        if ($request->link_video == null) {
        } else {
            $itemTutorial->link_video = '<iframe width="100%" height="350px" src="https://www.youtube.com/embed/' . $array['v'] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
        $itemTutorial->path_foto = $request->path_foto;
        $itemTutorial->tutorial_id = $request->tutorial_id;
        $path_foto = $request->file('path_foto');

        $dadosImagem = DB::table('item_tutorial')->select('item_tutorial.*')->where('item_tutorial.tutorial_id', '=', $request->tutorial_id)->where('item_tutorial.foto_principal', '=', true)->get();

        if ($dadosImagem == '[]') {
            $itemTutorial->foto_principal = true;
        } else {

        }
        if ($path_foto = $request->file('path_foto')) {

            $files = $request->path_foto;
            $extensao = $files->getClientOriginalExtension();
            $imageName = time() . '.' . $extensao;
            $itemTutorial->path_foto = $imageName;
            $request->path_foto->move(public_path('images'), $imageName);
            if ($itemTutorial->save()) {
                return redirect()->route('tutorial.show', $request->tutorial_id);
            } else {
                return redirect()->route('tutorial.show', $request->tutorial_id);
            }
        } else {
            if ($itemTutorial->save()) {
                return redirect()->route('tutorial.show', $request->tutorial_id);
            } else {
                return redirect()->route('tutorial.show', $request->tutorial_id);
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemTutorial = ItemTutorial::find($id);

        $idTutorial = $itemTutorial->tutorial_id;

        return view('tutoriais.edit', ['itemTutorial' => $itemTutorial, $idTutorial => 'idTutorial']);
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



        $itemTutorial = ItemTutorial::findOrFail($id);

        $itemTutorial->observacao = $request->observacao;

        if ($request->link_video == null) {
            # code...
        }else{

        }

        if ($request->link_video == null) {
            $itemTutorial->link_video = $request->link_video;
        } else {
        }

        if ($path_foto = $request->file('path_foto')) {

            $files = $request->path_foto;
            $extensao = $files->getClientOriginalExtension();
            $imageName = time() . '.' . $extensao;
            $itemTutorial->path_foto = $imageName;
            $request->path_foto->move(public_path('images'), $imageName);

        } else {

        }

        if ($itemTutorial->update()) {
            return redirect()->route('tutorial.show', $itemTutorial->tutorial_id);
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
        //
    }
}
