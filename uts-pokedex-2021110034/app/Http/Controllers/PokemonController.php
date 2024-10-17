<?php

namespace App\Http\Controllers;

use App\Models\pokemon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Ramsey\Uuid\Type\Decimal;

class PokemonController extends Controller
{

    public function index()
    {
        $data = pokemon::paginate(20);
        // dd($data);
        $data->getCollection()->transform(function ($item) {
            $item->power = $item->hp + $item->defense; 
            return $item; 
        });
        return view('index', compact('data'));
    }

    public function create()
    {
        // $newUser = pokemon::create(['name' => 'John Doe', 'email' => 'john@example.com']);
        return view('create');
    }

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

    public function show(string $id)
    {
        $data = pokemon::find($id);
        return view('show', compact('data'));
    }
    public function login()
    {
        return view('login');
    }
    public function postlogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    public function storeregister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required'

        ]);
        $data['password'] = Hash::make($request->password);

        User::create($data);
        return view('login');
    }

    public function edit(string $id)
    {
        $data = pokemon::find($id);
        return view('edit', compact('data'));
    }


    public function update(Request $request,string $id)
    {

        $request->validate([
            'name' => 'required|max:250',
            'species' => 'required|string|max:100',
            'primary_type' => 'nullable|string|max:50',
            'weight' => 'numeric|min:0|max:99999999.99',
            'height' => 'numeric|min:0|max:99999999.99',
            'hp' => 'integer|min:0|max:9999',
            'attack' => 'integer|min:0|max:9999',
            'defense' => 'integer|min:0|max:9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    

        $pokemon = Pokemon::findOrFail($id);
    
        // dd($request);
        if ($request->hasFile('photo')) {

            if ($pokemon->photo) {
                Storage::delete($pokemon->photo);
            }
    

            $path = $request->file('photo')->store('/','public'); 
            $pokemon->photo = $path; 
            // dd($path);
        }

        $pokemon->name = $request->input('name');
        $pokemon->species = $request->input('species');
        $pokemon->primary_type = $request->input('primary_type');
        $pokemon->weight = $request->input('weight');
        $pokemon->height = $request->input('height');
        $pokemon->hp = $request->input('hp');
        $pokemon->attack = $request->input('attack');
        $pokemon->defense = $request->input('defense');
        $pokemon->is_legendary = $request->input('is_legendary');
        // $pokemon->photo = $request->input('photo');
        $pokemon->save(); 
    

        return redirect()->route('index')->with('success', 'Pokémon updated successfully!');
    }
    

    public function destroy(string $id)
    {
        $data = pokemon::find($id);
        $data->delete();
        return redirect('index');
    }
}
