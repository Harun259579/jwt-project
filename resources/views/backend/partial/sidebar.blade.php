

<!-- Bootstrap JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{asset('assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{asset('assets/images/faces/abrar.jpg')}}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Abrar Faiyaj Harun</h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small" href="#">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/layouts/admin/dashboard">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

         <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('users.index') }}">
              <span class="menu-icon">
               <i class="mdi mdi-account"></i>

              </span>
              <span class="menu-title">Users</span>
            </a>
          </li>
          @can('blog.view')
           <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('blog.index') }}">
              <span class="menu-icon">
            <i class="mdi mdi-blogger"></i>
              </span>
              <span class="menu-title">Blog</span>
            </a>
          </li>
          @endcan

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.contacts') }}">
              <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>

              </span>
              <span class="menu-title">Contact</span>
            </a>
          </li>

  <li class="nav-item menu-items">
  <a class="nav-link" data-bs-toggle="collapse" href="#aboutMenu" role="button" aria-expanded="false" aria-controls="aboutMenu">
    <span class="menu-icon">
      <i class="mdi mdi-information-outline"></i>
    </span>
    <span class="menu-title">About</span>
    <i class="menu-arrow"></i>
  </a>
  <div class="collapse" id="aboutMenu">
    <ul class="nav flex-column sub-menu">
      <li class="nav-item"><a class="nav-link" href="{{ route('hero.index') }}">Hero Section</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('vission.index') }}">Vission Section</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('mission.index') }}">Mission Section</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('features.index') }}">Features Card Section</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('subscriptions.index') }}">Join Community Section</a></li>
    </ul>
  </div>
</li>



           <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('logout') }}">
              <span class="menu-icon">
                <i class="mdi mdi-logout"></i>
              </span>
              <span class="menu-title">logout</span>
            </a>
          </li>
        </ul>
      </nav>