<?php

namespace App\Http\Controllers\Web\Backend\CMS\ServicePage;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ServicePageController extends Controller
{


    //! One function for all section
    /*  public function serviceSection($section)
    {
        $data = CMS::where('page', Page::ServicePage)->where('section', $section)->first();
        return view('backend.layouts.cms.service-page.service-section', compact('data', 'section'));
    }

    public function storeServiceSection(Request $request)
    {
        $request->validate([
            'title'         => 'nullable',
            'description'   => 'nullable',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'section'       => 'required|string',
        ]);

        $section = $request->input('section');
        $data = CMS::where('page', Page::ServicePage)->where('section', $section)->first();

        if ($request->hasFile('image')) {
            if ($data) {
                $oldImagePath = $data->image;
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }
            }
            $featuredImage = Helper::fileUpload($request->file('image'), 'cms-image' . $section, $request->image);
        } else {
            $featuredImage = $data ? $data->image : null;
        }
            CMS::updateOrCreate(
            ['page'     => Page::ServicePage, 'section' => $section],
            ['title'    => $request->title, 'description' => $request->description, 'image' => $featuredImage]
        );

        return redirect()->back()->with('notify-success', 'Data Updated Successfully');
    } */




    public function serviceFeature()
    {

        $data[0] = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->first();
        $data[1] = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(1)->first();
        $data[2] = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(2)->first();
        $data[3] = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(3)->first();
        $data[4] = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(4)->first();

        return view('backend.layouts.cms.service-page.service-section', compact('data'));
    }


    public function storeserviceFeature(Request $request)
    {
        $request->validate([
            'title'         => 'nullable',
            'description'   => 'nullable',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);



        $data = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->first();

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
                'page'      => Page::ServicePage,
                'section'   => Section::ServiceSection,
            ],
            [
                'title'         => $request->title,
                'description'   => strip_tags($request->description),
                'image'         => $featuredImage,
            ]
        );

        if ($data) {
            return redirect()->back()->with('notify-success', 'Data Updated Successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Data Update Failed');
        }
    }



    public function storeserviceFeatureItemOne(Request $request)
    {
        $request->validate([
            'title'     => 'nullable',
            'sub_title' => 'nullable',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);
        $getData = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(1)->first();

        // Check Image Update
        // Handle image upload and replacement if a new image is provided

        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($getData) {
                $oldImagePath = $getData->image;
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }
            }

            $featuredImage = Helper::fileUpload($request->file('image'), 'cms-image', $request->image);
        } else {

            $featuredImage = $getData ? $getData->image : null;
        }if ($getData) {
            $data = $getData->update(
                [
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,
                ]
            );
        } else {
            $data = CMS::create(
                [
                    'page'          => Page::ServicePage,
                    'section'       => Section::ServiceSection,
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,

                ],
            );
        }

        if ($data) {
            return redirect()->back()->with('notify-success', 'Data Updated Successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Data Update Failed');
        }
    }


    public function storeserviceFeatureItemTwo(Request $request)
    {
        $request->validate([
            'title'     => 'nullable',
            'sub_title' => 'nullable',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);
        $getData = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(2)->first();

        // Check Image Update
        // Handle image upload and replacement if a new image is provided

        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($getData) {
                $oldImagePath = $getData->image;
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }
            }

            $featuredImage = Helper::fileUpload($request->file('image'), 'cms-image', $request->image);
        } else {

            $featuredImage = $getData ? $getData->image : null;
        }

        if ($getData) {
            $data = $getData->update(
                [
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,
                ]
            );
        } else {
            $data = CMS::create(
                [
                    'page'          => Page::ServicePage,
                    'section'       => Section::ServiceSection,
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,

                ],
            );
        }

        if ($data) {
            return redirect()->back()->with('notify-success', 'Data Updated Successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Data Update Failed');
        }
    }


    public function storeserviceFeatureItemThree(Request $request)
    {
        $request->validate([
            'title'         => 'nullable',
            'sub_title'     => 'nullable',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);
        $getData = CMS::where('page', Page::ServicePage)->where('section', Section::ServiceSection)->skip(3)->first();

        // Check Image Update
        // Handle image upload and replacement if a new image is provided

        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($getData) {
                $oldImagePath = $getData->image;
                if ($oldImagePath && File::exists(public_path($oldImagePath))) {
                    File::delete(public_path($oldImagePath));
                }
            }

            $featuredImage = Helper::fileUpload($request->file('image'), 'cms-image', $request->image);
        } else {

            $featuredImage = $getData ? $getData->image : null;
        }if ($getData) {
            $data = $getData->update(
                [
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,
                ]
            );
        } else {
            $data = CMS::create(
                [
                    'page'          => Page::ServicePage,
                    'section'       => Section::ServiceSection,
                    'title'         => $request->title,
                    'description'   => strip_tags($request->description),
                    'image'         => $featuredImage,

                ],
            );
        }

        if ($data) {
            return redirect()->back()->with('notify-success', 'Data Updated Successfully');
        } else {
            return redirect()->back()->with('notify-warning', 'Data Update Failed');
        }
    }

}