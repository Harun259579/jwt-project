@extends('backend.app')

@section('title', 'Home Page')

@push('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }

        select[name="section"] {
            background-color: #f0f4f8;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            font-size: 14px;
            color: #333;
            width: 100%;
        }

        select[name="section"] option {
            padding: 10px;
            font-size: 14px;
        }

        select[name="section"] option:selected {
            background-color: #007bff;
            color: white;
        }

        select[name="section"]:focus {
            outline: none;
            border-color: #007bff;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Home Page CMS</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Home Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">

    {{-- Hero Section --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Hero Section</h4>
                </div>
                <div class="card-body">
                    <form class="theme-form" action="{{ route('cms.homepage.section.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::HeroSection }}">

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="title">Title :</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Title" name="title" value="{{ $data['hero']->title ?? '' }}">
                            @error('title')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="sub_title">Sub Title :</label>
                            <input type="text" class="form-control" name="sub_title" value="{{ $data['hero']->sub_title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="description">Description :</label>
                            <textarea name="description" id="hero_description" class="form-control @error('description') is-invalid @enderror"
                                      placeholder="description" cols="30" rows="10">{{ old('description', $data['hero']->description ?? '') }}</textarea>
                            @error('description')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0">Image:</label>
                            <input class="form-control dropify @error('image') is-invalid @enderror"
                                   type="file"
                                   data-default-file="{{ !empty($data['hero']->image) ? asset($data['hero']->image) : '' }}"
                                   name="image">
                            @error('image')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0">Video:</label>
                            <input class="form-control dropify @error('video') is-invalid @enderror"
                                   type="file"
                                   data-default-file="{{ !empty($data['hero']->video) ? asset($data['hero']->video) : '' }}"
                                   name="video">
                            @error('video')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ route('cms.homepage.index') }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Pickup Section --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Pickup Section</h4>
                </div>
                <div class="card-body">
                    <form class="theme-form" action="{{ route('cms.homepage.section.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="section" value="{{ \App\Enums\Section::PickupSection }}">

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="title">Title :</label>
                            <input type="text" class="form-control" name="title" value="{{ $data['pickup']->title ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="description">Description :</label>
                            <textarea name="description" id="pickup_description" class="form-control"
                                      placeholder="description" cols="30" rows="5">{{ $data['pickup']->description ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0">Image:</label>
                            <input class="form-control dropify" type="file"
                                   data-default-file="{{ !empty($data['pickup']->image) ? asset($data['pickup']->image) : '' }}"
                                   name="image">
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- একইভাবে Vehicle_Health_Section, Choose_Card_Section, Repair_Service section বানানো যাবে --}}
    {{-- শুধু $data['vehicle'], $data['choose'], $data['repair'] ব্যবহার করতে হবে এবং section value update করতে হবে --}}
</div>
<!-- Container-fluid Ends-->

@endsection

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#hero_description'))
        .catch(error => { console.error(error); });

    ClassicEditor
        .create(document.querySelector('#pickup_description'))
        .catch(error => { console.error(error); });

    $('.dropify').dropify();
</script>
@endpush





use App\Http\Controllers\Web\HomePageController;

Route::prefix('cms')->name('cms.')->group(function () {

    // Home Page CMS - Index (show all sections)
    Route::get('home-page', [HomePageController::class, 'index'])->name('homepage.index');

    // Home Page CMS - Store/Update Section
    Route::patch('home-page/section/update', [HomePageController::class, 'store'])->name('homepage.section.update');

    // Optional: If you want create/store separate sections
    // Route::get('home-page/section/create', [HomePageController::class, 'createSection'])->name('homepage.section.create');
    // Route::post('home-page/section/store', [HomePageController::class, 'storeSection'])->name('homepage.section.store');
});
