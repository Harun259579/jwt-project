<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog List | Corona Admin</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container-scroller">
        @include('backend.partial.sidebar')
        @include('backend.partial.navbar')
        
        <div class="main-panel">
            <div class="content-wrapper">
<h2>Mission Section</h2>

<a href="{{ route('mision.create') }}" class="btn btn-success mb-3">Create Mission</a>

@if($mision)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $mision->title }}</td>
            <td>{{ $mision->description }}</td>
            <td>
                @if($mision->image)
                    <img src="{{ asset('storage/'.$mision->image) }}" alt="Mission Image" width="150">
                @else
                    N/A
                @endif
            </td>
            <td>
                <a href="{{ route('mision.edit', $mision->id) }}" class="btn btn-primary btn-sm">Edit</a>
            </td>
        </tr>
    </tbody>
</table>
@else
<p>No mission data found.</p>
@endif


</div>




            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                </div>
            </footer>
            </div>
        </div>


  

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>

</body>
</html>