<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuarios = DB::table('users')->count();
        $clientes = DB::table('cliente')->count();
        $tutoriais = DB::table('tutorial')->count();

        return view('dashboard', ['usuarios' => $usuarios, 'clientes' => $clientes, 'tutoriais' => $tutoriais]);
    }
}
