<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blabs = [
            [
                'author' => 'Jane Doe',
                'message' => 'Just deployed my first Laravel app! 🚀',
                'time' => '5 minutes ago'
            ],
            [
                'author' => 'John Smith',
                'message' => 'Laravel makes web development fun again!',
                'time' => '1 hour ago'
            ],
            [
                'author' => 'Alice Johnson',
                'message' => 'Working on something cool with Blabber...',
                'time' => '3 hours ago'
            ]
        ];

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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
