<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Airport;
use App\Http\Controllers\ApiController as API;

class APIController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public $token;

	public function __construct() {
		$this->getToken();
	}

    public function getToken()
    {
    	if (session('token')==""){
    	$URL = env(env('API_ENV'));
    	$curl = new \Curl\Curl();
    	$curl->setUserAgent('twh:22569101;Wololo.inc;');
    	$curl->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
    	$curl->get($URL."apiv1/payexpress",
    		array(
    			'method'=> 'getToken',
    			'secretkey'=> env(env('API_KEY')),
    			'output'=> 'json')
    		);
    	if($curl->error) {
    		\Session::put('token','');
    		die("Error:".$curl->error_code);
    	}
    	else {
    		$json = json_decode($curl->response);
    		$this->token = $json->token;
    		\Session::put('token',$json->token);
    	}
    } else {
    	$this->token = \Session::get('token');
    }

    }

    public function getCurl($endpoint, $data=array())
    {
    	$URL = env(env('API_ENV'));
    	$curl = new \Curl\Curl();
    	$curl->setUserAgent('twh:22569101;Wololo.inc;');
    	$curl->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
    	$data = array('output'=>'json', 'token'=>$this->token);
    	$curl->get($URL.$endpoint,$data);
    	if ($curl->error) {
    		die("Error:".$curl->error_code);
    	}
    	else {
    		$json = json_decode($curl->response);
    		return $json;
    	}
    }
    
    public function getFlight()
    {
        $data = Airport::all();
        return view('flight')->with('data', $data);
    }

}
