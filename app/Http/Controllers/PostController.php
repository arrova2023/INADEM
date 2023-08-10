<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        //$proyectos = DB::table('tecnologiaproyecto')->select('*');
        $proyectos = DB::select('select * from tecnologiaproyecto');
        return view('datatable', ['proyectos'=>$proyectos]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        $users = DB::table('demo_posts')->select('*');
        return Datatables::of($users)->make(true);
    }
}
