@php
$reservations = App\Models\Reservation::where('processed', '0')->latest()->get();
$messages = App\Models\Message::where('status', '0')->latest()->get();
@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="{{ url('/upload/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Head admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ (!empty($data->photo)) ? url('upload/head_admin_images/'.$data->photo) : url('upload/no_image.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('head_admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Pretraži" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('head_admin.dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Komandna tabla
              </p>
            </a>
          </li>
          <li class="nav-header">UPRAVLJAJ SOBAMA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Sobe
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('head_admin.add.room') }}" class="nav-link">
                  <i class="far fa-arrow-right nav-icon"></i>
                  <p>Dodaj sobu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('head_admin.all.rooms') }}" class="nav-link">
                  <i class="far fa-arrow-right nav-icon"></i>
                  <p>Sve sobe</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">UPRAVLJAJ REZERVACIJAMA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Rezervacije
                <i class="fas fa-angle-left right"></i>
                @if(count($reservations))
                <span class="badge badge-danger right">{{ count($reservations) }}</span>
                @else

                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('head_admin.all_reservations') }}" class="nav-link">
                  <i class="far fa-arrow-right nav-icon"></i>
                  <p>Sve rezervacije</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">UPRAVLJAJ PORUKAMA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Poruke
                <i class="fas fa-angle-left right"></i>
                @if(count($messages))
                <span class="badge badge-warning right">{{ count($messages) }}</span>
                @else

                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('head_admin.all_messages') }}" class="nav-link">
                  <i class="far fa-arrow-right nav-icon"></i>
                  <p>Sve poruke</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">UPRAVLJAJ KORISNICIMA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Korisnici
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('head_admin.all_users') }}" class="nav-link">
                  <i class="far fa-arrow-right nav-icon"></i>
                  <p>Svi korisnici</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<script type="text/javascript">
  

    var url = window.location;
    const allLinks = document.querySelectorAll('.nav-item a');
    const currentLink = [...allLinks].filter(e => {
    return e.href == url;
});

console.log("Link URL: " + url);

currentLink[0].classList.add("active")
currentLink[0].closest(".nav-treeview").style.display="block";
currentLink[0].closest(".has-treeview").classList.add("active");
</script>