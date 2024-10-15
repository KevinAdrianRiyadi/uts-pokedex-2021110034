<?php

namespace App\Http\Controllers;

use App\Models\pokemon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = pokemon::paginate(20);
        return view('index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $newUser = pokemon::create(['name' => 'John Doe', 'email' => 'john@example.com']);
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($request);
        $data = $request->validate([
            'name' => 'required|string|max:250',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|max:50',
            'weight' => 'numeric|min:0|max:99999999.99',
            'height' => 'numeric|min:0|max:99999999.99',
            'hp' => 'integer|min:0|max:9999',
            'attack' => 'integer|min:0|max:9999',
            'defense' => 'integer|min:0|max:9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data['is_legendary'] = $data['is_legendary'] ?? false;

        pokemon::create($data);
        return redirect()->route('index')->with('success', 'Data Inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = pokemon::find($id);
        return view('show   ',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = pokemon::find($id);
        return view('edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        pokemon::where('status', 'inactive')->update(['status' => 'active']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $data = pokemon::find($id);

        pokemon::where('id', $id)->delete();

    }
}
