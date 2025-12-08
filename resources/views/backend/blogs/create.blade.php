<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>

    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('aassets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
   
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>
  </head>
  <body>
    <div class="container-scroller">
      <!--include sidebar and navbar-->
      @include('backend.partial.sidebar')
      @include('backend.partial.navbar')

      <div class="main-panel">
    <div class="content-wrapper">
    
   <h2>Create Blog</h2>

<form id="createForm">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Sub Title</label>
        <input type="text" name="sub_title" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
        <label>Order</label>
        <input type="number" name="order_id" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<div id="alertArea"></div>




         
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
 
        </div>
  
      </div>

    </div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$("#createForm").on("submit", function(e) {
    e.preventDefault(); // stop page reload

    $.ajax({
        url: "{{ route('blog.store') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function (response) {
            $("#alertArea").html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Blog created successfully!
                </div>
            `);

            // clear form
            $("#createForm")[0].reset();

            // auto hide alert
            setTimeout(() => {
                $(".alert").fadeOut();
            }, 2000);
        },
        error: function(xhr){
            $("#alertArea").html(`
                <div class="alert alert-danger">
                    Something went wrong!
                </div>
            `);
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>


