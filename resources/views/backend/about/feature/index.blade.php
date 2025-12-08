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
           <h2>Feature Section</h2>
 <a href="{{ route('features.create') }}" class="btn btn-primary mb-3">Add New Feature</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Icon</th>
        <th>Title</th>
        <th>Description</th>
        
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($features as $f)
        <tr>
          <td>{{ $f->id }}</td>
          <td>
            @if($f->icon)
              <img src="{{ asset('storage/'.$f->icon) }}" width="50">
            @endif
          </td>
          <td>{{ $f->title }}</td>
          <td>{{ $f->description }}</td>
          
          <td>
            <a href="{{ route('features.edit', $f->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('features.destroy', $f->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure?')">Delete</button>
            </form>
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