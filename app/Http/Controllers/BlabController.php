<?php

namespace App\Http\Controllers;

use App\Models\Blab;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BlabController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $blabs = Blab::with('user')
            ->latest()
            ->take(25)
            ->get();
            
            return view('home', ['blabs' => $blabs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to blab!',
            'message.max' => 'Blabs must be 255 characters or less.',
        ]);

        auth()->user()->blabs()->create($validated);

        return redirect('/')->with('success', 'Your blab has been posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blab $blab)
    {
        $this->authorize('update', $blab);

        return view('blabs.edit', compact('blab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blab $blab)
    {
        $this->authorize('update', $blab);

        $validated = $request->validate([
        'message' => 'required|string|max:255',
    ]);

    $blab->update($validated);

    return redirect('/')->with('success', 'Blab updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blab $blab)
    {
        $this->authorize('update', $blab);
    
    $blab->delete();

    return redirect('/')->with('success', 'Blab deleted!');
    }
}
