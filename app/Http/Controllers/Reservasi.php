<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController as API;

class Reservasi extends Controller {

	public function flight()
	{
		//add airport data
		$s = \App\Airport::all();
		return view('reservasi.flight')->with('airport',$s);
	}

}