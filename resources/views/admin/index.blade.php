@extends('admin.admin_dashboard')
@section('admin')

@php

$users = App\Models\User::latest()->count();
$active_users = App\Models\User::where('status', 'active')->latest()->count();
$reservations = App\Models\Reservation::where('processed', '1')->latest()->count();
$reservations2 = App\Models\Reservation::where('cancelled', '0')->latest()->count();
$rooms = App\Models\Room::latest()->count();
$messages = App\Models\Message::latest()->count();
$answered_messages = App\Models\Message::where('status', '1')->latest()->count();
date_default_timezone_set('Europe/Belgrade');
$today = date('Y-m-d');
$today_reservations = App\Models\Reservation::where('arriving_date', $today)
    ->where('processed', '1')
    ->latest()
    ->get();


@endphp

@if(Auth::user()->status=="active")
<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Vaš nalog je <span class="text text-success">aktivan</span></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <hr>

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Komandna tabla</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ukupan broj rezervacija</span>
                <span class="info-box-number">{{ $reservations+$reservations2 }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ukupan broj soba</span>
                <span class="info-box-number">{{ $rooms }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Statistika</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">

                    <div class="progress-group">
                      Obrađene rezervacije
                      <span class="float-right"><b>{{ $reservations }}</b>/{{ $reservations2 }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width:{{ $reservations / $reservations2 * 100 }}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      <span class="progress-text">Odgovorene poruke</span>
                      <span class="float-right"><b>{{ $answered_messages }}</b>/{{ $messages }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: {{ $answered_messages/$messages * 100}}%"></div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
          <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Današnji dolasci</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>ID rezervacije</th>
                        <th>Broj sobe</th>
                        <th>Ime i prezime</th>
                        <th>Email</th>
                        <th>Telefon</th>
                      </tr>
                      </thead>
                      <tbody>
                        @if($today_reservations->count()>0)
                          @foreach($today_reservations as $reservation)
                            <tr>
                              <td>{{ $reservation->id }}</td>
                              <td>{{ $reservation->Room->number }}</td>
                              <td>{{ $reservation->name }}</td>
                              <td>{{ $reservation->email }}</td>
                              <td>{{ $reservation->phone }}</td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td colspan="5" style="text-align: center;">Nema dolazaka za današnji dan.</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
              </div>
          </div>  
          </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@else
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Vaš nalog je <span class="text text-danger">neaktivan</span></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endif
@endsection