<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About\Vision;

class VisionController extends Controller
{
    // Display the first vision
    public function index() {
        $vision = Vision::first();
        return view('backend.about.vission.index', compact('vision'));
    }

    // Show the form to create a new vision
    public function create() {
        return view('backend.about.vission.create');
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

        Vision::create($data);

        return redirect()->route('vission.index')->with('success', 'Vision created successfully.');
    }

    // Show the form to edit an existing vision
    public function edit($id) {
        $vision = Vision::findOrFail($id);
        return view('backend.about.vission.edit', compact('vision'));
    }

    // Update an existing vision
    public function update(Request $request, $id) {
        $vision = Vision::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $vision->update($data);

        return back()->with('success', 'Vision updated successfully.');
    }
}
