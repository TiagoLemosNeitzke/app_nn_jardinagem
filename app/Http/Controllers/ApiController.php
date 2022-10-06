<?php

namespace App\Http\Controllers;

use App\Models\Webhook;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $dataToString = json_encode($data);
        Webhook::create(['webhook' => $dataToString, 'type' => '123']);
        //dd($dataToString, $data['hub_challenge']);
        return $data['hub_challenge'];
    }
}
