<?php

namespace App\Http\Controllers;

use App\Models\pokemon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Ramsey\Uuid\Type\Decimal;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = pokemon::paginate(20);

        // Calculate the power for each item
        $data->getCollection()->transform(function ($item) {
            $item->power = $item->hp + $item->defense; // Calculate power
            return $item; // Return the modified item
        });
        return view('index', compact('data'));
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
        return view('show', compact('data'));
    }
    public function login()
    {
        return view('login');
    }
    public function postlogin(Request $request)
    {

        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $request->session()->regenerate();
            return redirect()->intended('index'); // redirect to intended page or dashboard
        }

        // Authentication failed
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

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page or home page after logout
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = pokemon::find($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = pokemon::find($id);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data= pokemon::findorFail('id', $id);
        $data->delete();
        return view('index');
    }
}
