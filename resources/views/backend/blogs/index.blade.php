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
                <h2>Blog List</h2>
                @can('blog.create')
                <a href="{{ route('blog.create') }}" class="btn btn-success mb-3">Add Blog</a>
                @endcan
                <div id="alertArea"></div>


            <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle" id="blogTable">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Sub Title</th>
                <th scope="col">Description</th>
                <th scope="col">Order</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td class="text-center">{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->sub_title ?? '-' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($blog->description, 50) }}</td>
                <td class="text-center">{{ $blog->order_id ?? '-' }}</td>
                <td class="text-center">{{ $blog->created_at->format('d-m-Y') }}</td>
                <td class="text-center">
                    @can('blog.edit')
                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary me-1" title="Edit Blog">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    @endcan
                    @can('blog.delete')
                    <a href="{{ route('blog.delete', $blog->id) }}" class="btn btn-sm btn-danger deleteBtn" title="Delete Blog">
                        <i class="mdi mdi-delete"></i>
                    </a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>




            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                </div>
            </footer>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<script>
$(document).on('click', '.deleteBtn', function(e){
    e.preventDefault();

    let url = $(this).attr("href");
    let row = $(this).closest("tr");  // identify table row

    if(!confirm("Are you sure you want to delete this blog?")){
        return;
    }

    $.ajax({
        url: url,
        type: "GET",
        success: function(response){

            // show success message
            $("#alertArea").html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            

            // remove the row without reload
            row.fadeOut(400, function(){
                row.remove();
            });
        },
        error: function(xhr){
            $("#alertArea").html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Delete failed!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
        }
    });
});
</script>



  

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