<?php

namespace App\Http\Controllers\Web;

use App\Enums\Page;
use App\Enums\Section;
use App\Models\HomePageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomePageController extends Controller
{
    

     public function storeherosection(Request $request)
    {
        $request->validate([
            'title'         => 'nullable',
            'sub_title'     =>'nullable',      
            'button_text'   =>'nullable',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);



        $data = HomePageContent::where('page', Page::HomePage)->where('section', Section::HeroSection)->first();

        // Check Image Update
        // Handle image upload and replacement if a new image is provided

        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($data) {
                $oldImagePath = $data->image;
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }
            }

            // Generate a random string and store new image
            $featuredImage = Helper::fileUpload($request->file('image'), 'cms-image', $request->image);
        } else {
            $featuredImage = $data ? $data->image : null;
        }

        // Update or create record
        $data = CMS::updateOrCreate(
            [
                'page'      => Page::HomePage,
                'section'   => Section::HeroSection,
            ],
            [
                'title'         => $request->title,
                'sub_title'     => $request->sub_title,
                'button_text'     => $request->button_text,
                'image'         => $featuredImage,
            ]
        );

        if ($data) {
            return redirect()->back()->with('notify-success', 'Data Updated Successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Data Update Failed');
        }
    }
}
