<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller; 
use App\Models\About\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    // Display all heroes
    public function index()
    {
        $hero = Hero::first(); // for single hero section
        return view('backend.about.hero.index', compact('hero'));
    }

    // Show the form to create a new hero
    public function create()
    {
        return view('backend.about.hero.create');
    }

    // Store a new hero
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image',
            'background_image' => 'nullable|image',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('uploads', 'public');
        }

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('uploads', 'public');
        }

        Hero::create($data);

        return redirect()->route('hero.index')->with('success', 'Hero section created successfully.');
    }

    // Show the form to edit an existing hero
    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('backend.about.hero.edit', compact('hero'));
    }

    // Update an existing hero
    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image',
            'background_image' => 'nullable|image',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('uploads', 'public');
        }

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('uploads', 'public');
        }

        $hero->update($data);

        return redirect()->route('hero.index')->with('success', 'Hero section created successfully.');

        return back()->with('success', 'Hero section updated successfully.');
    }

    // Optional: Delete a hero
    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();
        return back()->with('success', 'Hero section deleted successfully.');
    }
}
