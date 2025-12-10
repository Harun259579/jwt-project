<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home Page | Corona Admin</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>

    @stack('styles')

    <style>
    /* CKEditor box minimum height */
    .ck-editor__editable[role="textbox"] {
        min-height: 150px;
        color: black;          
        background-color: white;
    }

    /* Dropdown styling */
    select[name="section"] {
        background-color: white;
        color: black;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
    }
</style>


</head>
<body>

<div class="container-scroller">

    {{-- SIDEBAR --}}
    @include('backend.partial.sidebar')

    {{-- NAVBAR --}}
    @include('backend.partial.navbar')

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-title mb-3">
                <h3>Home Page CMS</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
                    <li class="breadcrumb-item active">Home Page</li>
                </ol>
            </div>

{{-- ------------------------------------------------ --}}
{{-- HERO SECTION --}}
{{-- ------------------------------------------------ --}}
<div class="card mb-4">
    <div class="card-header pb-0">
        <h4>Hero Section</h4>
    </div>
    <div class="card-body">

        <form action="{{ $data['hero'] ? route('cms.homepage.section.update', $data['hero']->id) : route('cms.homepage.section.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($data['hero'])
                @method('PATCH')
            @endif

            <input type="hidden" name="page" value="{{ \App\Enums\Page::HomePage }}">
            <input type="hidden" name="section" value="{{ \App\Enums\Section::HeroSection }}">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control"
                       value="{{ $data['hero']->title ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Sub Title</label>
                <input type="text" name="sub_title" class="form-control"
                       value="{{ $data['hero']->sub_title ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control dropify"
                       data-default-file="{{ !empty($data['hero']->image) ? asset($data['hero']->image) : '' }}">
                
                {{-- Show existing image --}}
                @if(!empty($data['hero']->image))
                    <div class="mt-2">
                        <img src="{{ asset($data['hero']->image) }}" alt="Current Image" 
                             style="max-width: 200px; max-height: 150px; border:1px solid #ddd; padding:2px;">
                    </div>
                @endif
            </div>

            <button class="btn btn-primary">{{ $data['hero'] ? 'Update' : 'Create' }}</button>
        </form>

    </div>
</div>

            {{-- ------------------------------------------------ --}}
            {{-- PICKUP SECTION --}}
            {{-- ------------------------------------------------ --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Pickup Section</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('cms.homepage.section.update') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="page" value="{{ \App\Enums\Page::HomePage }}">
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::PickupSection }}">

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $data['pickup']->title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="pickup_description" name="description" class="form-control" rows="4">
                                {{ $data['pickup']->description ?? '' }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control dropify"
                                   data-default-file="{{ !empty($data['pickup']->image) ? asset($data['pickup']->image) : '' }}">
                                    @if(!empty($data['pickup']->image))
                           <div class="mt-2">
                           <img src="{{ asset($data['pickup']->image) }}" alt="Current Image" style="max-width: 200px; max-height: 150px; border:1px solid #ddd; padding:2px;">
                            </div>
                            @endif
                        </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

            {{-- ------------------------------------------------ --}}
            {{--Vichle Health SECTION --}}
            {{-- ------------------------------------------------ --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Vichle Health Section</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('cms.homepage.section.update') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="page" value="{{ \App\Enums\Page::HomePage }}">
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::Vehicle_Health_Section }}">

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $data['vehicle']->title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="vichle_description" name="description" class="form-control" rows="4">
                                {{ $data['vehicle']->description ?? '' }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control dropify"
                                   data-default-file="{{ !empty($data['vehicle']->image) ? asset($data['vehicle']->image) : '' }}">
                                 @if(!empty($data['vehicle']->image))
                           <div class="mt-2">
                           <img src="{{ asset($data['vehicle']->image) }}" alt="Current Image" style="max-width: 200px; max-height: 150px; border:1px solid #ddd; padding:2px;">
                            </div>
                            @endif
                        </div>
                                

                        <button class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>





            {{-- ------------------------------------------------ --}}
            {{--Why Choose SECTION --}}
            {{-- ------------------------------------------------ --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Why Choose Section</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('cms.homepage.section.update') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="page" value="{{ \App\Enums\Page::HomePage }}">
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::Choose_Card_Section }}">

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $data['choose']->title ?? '' }}">
                        </div>
                          <div class="mb-3">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title" class="form-control"
                                   value="{{ $data['choose']->sub_title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="choose_description" name="description" class="form-control" rows="4">
                                {{ $data['choose']->description ?? '' }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control dropify"
                                   data-default-file="{{ !empty($data['choose']->image) ? asset($data['choose']->image) : '' }}">
                        @if(!empty($data['choose']->image))
                           <div class="mt-2">
                           <img src="{{ asset($data['choose']->image) }}" alt="Current Image" style="max-width: 200px; max-height: 150px; border:1px solid #ddd; padding:2px;">
                            </div>
                            @endif
                       
                                </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>


             {{-- ------------------------------------------------ --}}
            {{--Repair Service SECTION --}}
            {{-- ------------------------------------------------ --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Repair Service Section</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('cms.homepage.section.update') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="page" value="{{ \App\Enums\Page::HomePage }}">
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::Repair_Service }}">

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $data['repair']->title ?? '' }}">
                        </div>
                          <div class="mb-3">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title" class="form-control"
                                   value="{{ $data['repair']->sub_title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="repair_description" name="description" class="form-control" rows="4">
                                {{ $data['repair']->description ?? '' }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control dropify"
                                   data-default-file="{{ !empty($data['repair']->image) ? asset($data['repair']->image) : '' }}">
                        @if(!empty($data['repair']->image))
                           <div class="mt-2">
                           <img src="{{ asset($data['repair']->image) }}" alt="Current Image" style="max-width: 200px; max-height: 150px; border:1px solid #ddd; padding:2px;">
                            </div>
                            @endif
                                </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

            

        </div>
      

        </div>

        {{-- FOOTER --}}
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center">Copyright © 2025</span>
            </div>
        </footer>
    </div>

</div>



<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor.create(document.querySelector('#hero_description'));
    ClassicEditor.create(document.querySelector('#pickup_description'));
    ClassicEditor.create(document.querySelector('#vichle_description'));
    ClassicEditor.create(document.querySelector('#choose_description'));
    ClassicEditor.create(document.querySelector('#repair_description'));

    
    $('.dropify').dropify();
</script>

@stack('scripts')

</body>
</html>
