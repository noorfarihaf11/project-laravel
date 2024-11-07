<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuacaController extends Controller
{
    public function get_data_cuaca(){
        $data = DB::table('cuaca')->get()->toAarray();
        echo json_encode($data);
    }
}
