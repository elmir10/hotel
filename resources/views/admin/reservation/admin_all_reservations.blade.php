@extends('admin.admin_dashboard')
@section('admin')

<div class="card">
              <div class="card-header">
                <h1 class="card-title">Sve rezervacije</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Broj sobe</th>
                    <th>Dolazak</th>
                    <th>Odlazak</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Stanje</th>
                    <th>Aktivnost</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($reservations as $key => $reservation)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $reservation->room_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->arriving_date)->format('d. F Y.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->departure_date)->format('d. F Y.') }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>@if($reservation->processed)
                        <a href="#" class="badge rounded-pill bg-success" disabled style="cursor: default;">Odobrena</a></td>
                        @else
                            @if($reservation->cancelled)
                                <a href="#" class="badge rounded-pill bg-danger" disabled style="cursor: default;">Otkazana</a></td>    
                            @else
                                <a href="#" class="badge rounded-pill bg-warning" disabled style="cursor: default;">Na čekanju</a></td>
                            @endif
                        @endif
                    </td>
                    
                    <td>
                        @if($reservation->processed == '1')
                            <a href="#" class="btn btn-success" title="Rezervacija je odobrena" disabled><i class="fa fa-check"></i></a></td>
                        @else
                            <a href="{{ route('admin.approve_reservation', $reservation->id) }}" class="btn btn-success" title="Odobri" id="approve"><i class="fa fa-check"></i></a></td>
                        @endif
                  </tr>       
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Broj sobe</th>
                    <th>Dolazak</th>
                    <th>Odlazak</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Stanje</th>
                    <th>Aktivnost</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection