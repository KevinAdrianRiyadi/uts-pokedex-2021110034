<?php

namespace App\Http\Controllers;

use App\Models\pokemon;
use Illuminate\Http\Request;

class PokedexController extends Controller
{
    public function index()
    {
        $data = pokemon::paginate(9);
        $data->getCollection()->transform(function ($item) {
            $item->power = $item->hp + $item->defense; 
            return $item; 
        });
        return view('indexpokedex', compact('data'));
    }
}
