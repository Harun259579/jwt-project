<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About\Mission;

class MissionController extends Controller
{
    // Display the first vision
    public function index() {
        $mision = Mission::first();
        return view('backend.about.mission.index', compact('mision'));
    }

    // Show the form to create a new vision
    public function create() {
        return view('backend.about.mission.create');
    }

    // Store a new vision
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        Mission::create($data);

        return redirect()->route('mission.index')->with('success', 'Mission created successfully.');
    }

    // Show the form to edit an existing vision
    public function edit($id) {
        $mision = Mission::findOrFail($id);
        return view('backend.about.mission.edit', compact('mision'));
    }

    // Update an existing vision
    public function update(Request $request, $id) {
        $mision = Mission::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $mision->update($data);

        return back()->with('success', 'Mission updated successfully.');
    }
}
