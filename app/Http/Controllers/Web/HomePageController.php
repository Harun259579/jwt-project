<?php

namespace App\Http\Controllers\Web;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomePageController extends Controller
{

    /**
     * Load all homepage sections data
     */
    public function index()
    {
        $data['hero']      = HomePageContent::where('page', Page::HomePage)->where('section', Section::HeroSection)->first();
        $data['pickup']    = HomePageContent::where('page', Page::HomePage)->where('section', Section::PickupSection)->first();
        $data['vehicle']   = HomePageContent::where('page', Page::HomePage)->where('section', Section::Vehicle_Health_Section)->first();
        $data['choose']    = HomePageContent::where('page', Page::HomePage)->where('section', Section::Choose_Card_Section)->first();
        $data['repair']    = HomePageContent::where('page', Page::HomePage)->where('section', Section::Repair_Service)->first();

        return view('backend.cms.home-page.index', compact('data'));
    }


    /**
     * Common Save/Update Function for all Sections
     */
    public function store(Request $request)
    {
        $request->validate([
            'section'         => 'required',
            'title'           => 'nullable',
            'sub_title'       => 'nullable',
            'description'     => 'nullable',
            'sub_description' => 'nullable',
            'main_text'       => 'nullable',
            'sub_text'        => 'nullable',
            'button_text'     => 'nullable',
            'sub_button_text' => 'nullable',
            'link_url'        => 'nullable',
            'email'           => 'nullable',
            'phone'           => 'nullable',
            'location'        => 'nullable',
            'status'          => 'nullable',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'video'           => 'nullable',
        ]);

        $section = $request->section;

        // Get existing data
        $data = HomePageContent::where('page', Page::HomePage)
            ->where('section', $section)
            ->first();

        // Image Upload
        if ($request->hasFile('image')) {

            if ($data) {
                $oldImage = $data->image;
                if ($oldImage && File::exists(public_path($oldImage))) {
                    File::delete(public_path($oldImage));
                }
            }

            $imagePath = Helper::fileUpload($request->image, 'homepage/' . $section, $request->image);
        } else {
            $imagePath = $data ? $data->image : null;
        }


        // Video (if any)
        if ($request->hasFile('video')) {

            if ($data) {
                $oldVideo = $data->video;
                if ($oldVideo && File::exists(public_path($oldVideo))) {
                    File::delete(public_path($oldVideo));
                }
            }

            $videoPath = Helper::fileUpload($request->video, 'homepage/' . $section, $request->video);
        } else {
            $videoPath = $data ? $data->video : null;
        }


        // Update or Create
        $save = HomePageContent::updateOrCreate(
            [
                'page'    => Page::HomePage,
                'section' => $section,
            ],
            [
                'title'            => $request->title,
                'sub_title'        => $request->sub_title,
                'description'      => $request->description,
                'sub_description'  => $request->sub_description,
                'main_text'        => $request->main_text,
                'sub_text'         => $request->sub_text,
                'button_text'      => $request->button_text,
                'sub_button_text'  => $request->sub_button_text,
                'link_url'         => $request->link_url,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'location'         => $request->location,
                'status'           => $request->status,
                'image'            => $imagePath,
                'video'            => $videoPath,
            ]
        );

        if ($save) {
            return redirect()->back()->with('notify-success', 'Homepage content updated successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Homepage content update failed');
        }
    }
}
