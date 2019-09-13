<?php

namespace App\Http\Controllers;
use Silverpop\EngagePod;
use Illuminate\Http\Request;


class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function index() {               
        $products = ['Tela', 'Televisor', 'Teléfono'];
        return view('index')->with('products', $products);
    }

    public function getToken() {
        $host = 'https://api2.ibmmarketingcloud.com:443/rest';
        $key = 'javierlpedroza@qdata.io';
        $secret = 'E1s13N}n';
        $refreshToken = 'ac1bfab0-f310-4161-9f6b-53cabac451a8';
        
        $fields = array(
        'client_id' => $key,
        'client_secret' => $secret,
        'refresh_token' => $refreshToken,
        'grant_type' => 'refresh_token'
        );
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        $json_result = curl_exec($ch);
        
        $result = json_decode($json_result);
        dd($result);
    }

    public function setData(Request $request) {       
       // self::getToken(); 
        	
	
        $auth = array(
			'username'       => 'javierlpedroza@qdata.io',//'api_bancolombia@chef.com', c
			'password'       => 'E1s13N}n',//'IBMBancolombia2015!',
			'engage_server'  => 3,
        );
        $silverpop = new EngagePod($auth);   


        $cat = array(
            '1' => '10086176'
        );

        if (isset($request['dataUser'])) {
            if ($request['dataUser']['document'] && empty($request['dataUser']['document'])) {
                self::response('Error: el campo Documento es obligatorio, por favor ingresarlo.');
            } else if ($request['dataUser']['name'] && empty($request['dataUser']['document'])) {
                self::response('Error: el campo Nombre es obligatorio, por favor ingresarlo.');
            } else if ($request['dataUser']['lastName'] && empty($request['dataUser']['document'])) {
                self::response('Error: el campo Apellido es obligatorio, por favor ingresarlo.');
            } else {
                $columns = array(
                    'documento' => 'CC',
					'numeroDocumento' => 	$request['dataUser']['document'],
					'nombre' =>	$request['dataUser']['name'],
                    'apellido' => $request['dataUser']['lastName'],
                    'celular' => 3114426177,
                    'producto' => 'telefono',
                    'correo' => 'javierlpedroza@qdata.io',
                    'aceptaTerminos' => true,
                );
               
                $addContact = $silverpop->addContact($cat[1], true, $columns);
                self::response($addContact);
            }

            
        }

        // if ($request['dataUser']['JOB_ID']) {
            
        //     $list  = $silverpop->getLists(2, true, null);
        //     dd($list);
        //     self::response("respuesta ", $list);
        //     //dd($list);
        // }
        // if(isset($info->data) && $info->data != ''){	
        //     dd($info->data);	
        //     if($info->data->name == ''){

        //     }else{
        //         $columns = array(
		// 			'Nombre' => 	$info->data->name,
		// 			'Apellido' =>	$info->data->lastname,
		// 			'Email' => 		$info->data->email
		// 	    );
        //     }
        // }else{
        //     response('Error: El valor data no puede venir vacio.');	
        // }
        
    }


    
    
	public function response($msg){
		echo json_encode(array('msg' => $msg));	
		die();
	}

    public function store(Request $request)
    {
        $this->validate($request, [
        'form' => 'required',
        'name' => 'required',
        'user_id' => 'required',
        'description' => 'required'
         ]);
        if(Auth::user()->todo()->Create($request->all())){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }

    //
}
