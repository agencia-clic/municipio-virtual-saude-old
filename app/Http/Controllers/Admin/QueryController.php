<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Http;
use Cache;

class QueryController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function city(Request $request)
    {
        $res = Cache::remember("city:{$request->uf}", env('TIME_CACHE'), function () use ($request)
        {
            return Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$request->uf}/municipios")->json();
        });

        $option = '<option value="" selected="selected">...</option>';
        if(!empty($res)):

            $option = null;

            foreach ($res as $value):

                $a = "";
                if($value['nome'] == $request->naturalness):
                    $a = "selected='selected'";
                endif;

                $option .= "<option value='{$value['nome']}' {$a}>{$value['nome']}</option>";

            endforeach;
        endif;

        return $option;
    }
}
