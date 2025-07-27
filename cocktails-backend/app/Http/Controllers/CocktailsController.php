<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CocktailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cocktails = Cocktail::latest()->get();
        return view('cocktails.index', compact('cocktails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cocktails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // Max 2MB TODO: потом надо будет этот момент отладить
        ]);

        $cocktail = new Cocktail();
        $cocktail->name = $request->name;
        $cocktail->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $cocktail->image = $imagePath;
        }

        $cocktail->save();

        return redirect()->route('cocktails.index')->with('success', 'CockTail успешно добавлен, петушок');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cocktail $cocktail)
    {
        return view('cocktails.show', compact('cocktail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cocktail $cocktail)
    {
        return view('cocktails.edit', compact('cocktail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cocktail $cocktail)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // Max 2MB TODO: потом надо будет этот момент отладить
        ]);

        $cocktail->name = $request->name;
        $cocktail->description = $request->description;

        if ($request->hasFile('image')) {
            if ($cocktail->image) {
                Storage::delete('public/' . $cocktail->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
            $cocktail->image = $imagePath;
        }

        $cocktail->save();

        return redirect()->route('cocktails.index')->with('success', 'CockTail успешно обновлён, петушок');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cocktail $cocktail)
    {
        if($cocktail->image){
            Storage::delete('public/'.$cocktail->image);
        }
        $cocktail->delete();

        return redirect()->route('cocktails.index')->with('success', 'CockTail успешно УДАЛЁН, петушок');
    }
}
