<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::latest()->get();
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $ingredients = new Ingredient();
        $ingredients->name = $request->name;
        $ingredients->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ingredients', 'public');
            $ingredients->image = $imagePath;
        }

        $ingredients->save();

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $ingredient->name = $request->name;
        $ingredient->description = $request->description;

        if ($request->hasFile('image')) {
            if ($ingredient->image) {
                Storage::delete('public/' . $ingredient->image);
            }
            $imagePath = $request->file('image')->store('ingredients', 'public');
            $ingredient->image = $imagePath;
        }

        $ingredient->save();

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        if($ingredient->image){
            Storage::delete('public/'.$ingredient->image);
        }
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно удалён');
    }
}
