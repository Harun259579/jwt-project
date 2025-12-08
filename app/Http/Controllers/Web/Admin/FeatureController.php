<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About\Feature;


class FeatureController extends Controller
{
    public function index() {
        $features = Feature::all();
        return view('backend.about.feature.index', compact('features'));
    }

    public function create() {
        return view('backend.about.feature.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'icon' => 'nullable|image',
            'title' => 'required',
            'description' => 'required',
            
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('uploads', 'public');
        }

        Feature::create($data);
        return redirect()->route('features.index')->with('success', 'Feature created.');
    }

    public function edit($id) {
        $feature = Feature::findOrFail($id);
        return view('backend.about.feature.edit', compact('feature'));
    }

    public function update(Request $request, $id) {
        $feature = Feature::findOrFail($id);

        $data = $request->validate([
            'icon' => 'nullable|image',
            'title' => 'required',
            'description' => 'required',
            
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('uploads', 'public');
        }

        $feature->update($data);

        return redirect()->route('features.index')->with('success', 'Feature updated.');
    }

    public function destroy($id) {
        Feature::findOrFail($id)->delete();
        return back()->with('success', 'Feature deleted.');
    }
}


