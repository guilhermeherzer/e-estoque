<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AppController extends Controller
{
    //
	public function index(Request $request){
		$tipos = DB::table('tipos_produtos')
			->where('status', 0)
			->orderBy('nome', 'asc')
			->get();
		$data = array('tipos' => $tipos);

		return view('app', compact('data'));
	}
}
