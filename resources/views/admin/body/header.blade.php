@php
  $reservations = App\Models\Reservation::where('processed', '0')->latest()->take(3)->get();
  $messages = App\Models\Message::where('status', '0')->latest()->take(3)->get();
@endphp

<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      @if(Auth::user()->status=="active")

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          @if(count($messages)>0)
            @if(count($messages)>2)
              <span class="badge badge-warning navbar-badge">{{ count($messages) }}+</span>
            @else
              <span class="badge badge-warning navbar-badge">{{ count($messages) }}</span>
            @endif
          @else

          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
          @if(count($messages)>2) 
            {{ count($messages) }}+ poruke
          @elseif(count($messages)==1) 
            {{ count($messages) }} poruka 
          @else 
          {{ count($messages) }} poruke 
          @endif</span>
          <div class="dropdown-divider"></div>
          @foreach($messages as $message)
          <div class="dropdown-divider"></div>
            <a href="{{ route('head_admin.all_messages_notification') }}" class="dropdown-item" style="background-color: #343b3e">
              <span class="float-right text-muted text-sm" style="margin-top: 0.1rem;">{{ Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
              <br>
              <i class="fas fa-comments mr-2"></i> {{Illuminate\Support\Str::limit($message->name, $limit = 10, $end = '...')}} je poslao poruku.
            </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{ route('head_admin.all_messages_notification') }}" class="dropdown-item dropdown-footer">Pogledaj sve poruke</a>
        </div>
      </li>  
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if(count($reservations)>0)
            @if(count($reservations)>2)
              <span class="badge badge-danger navbar-badge">{{ count($reservations) }}+</span>
            @else
              <span class="badge badge-danger navbar-badge">{{ count($reservations) }}</span>
            @endif
          @else

          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ count($reservations) }} @if(count($reservations)==1) zahjev za rezervaciju @else zahjeva za rezervaciju @endif</span>
          <div class="dropdown-divider"></div>
          @foreach($reservations as $reservation)
          <div class="dropdown-divider"></div>
            <a href="{{ route('head_admin.all_reservations_notification') }}" class="dropdown-item" style="background-color: #343b3e">
              <span class="float-right text-muted text-sm" style="margin-top: 0.1rem;">{{ Carbon\Carbon::parse($reservation->created_at)->diffForHumans()}}</span>
              <br>
              <i class="fas fa-envelope mr-2"></i> {{Illuminate\Support\Str::limit($reservation->name, $limit = 16, $end = '...')}} želi rezervaciju.
            </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.all_reservations_notification') }}" class="dropdown-item dropdown-footer">Pogledaj sve zahtjeve</a>
        </div>
      </li>

      @else

      @endif
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.profile') }}" class="dropdown-item">
            <i class="far fa-address-card mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.change.password') }}" class="dropdown-item">
            <i class="fas fa-wrench mr-2"></i> Promijeni lozinku
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.picture') }}" class="dropdown-item">
            <i class="fas fa-image mr-2"></i> Promijeni fotografiju
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.logout') }}" class="dropdown-item dropdown-footer">
          Odjavi se
        </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>