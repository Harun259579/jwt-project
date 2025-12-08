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
<h4>Edit User</h4>

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
            <option value="runner" {{ $user->role == 'runner' ? 'selected' : '' }}>Runner</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control" required>
            <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label>New Password (Optional)</label>
        <input type="password" name="password" class="form-control">
        <small class="text-muted">If You Change Your Password Please Write Here...</small>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
        
</div>
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