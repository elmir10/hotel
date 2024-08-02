@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<div class="card">
              <div class="card-header">
                <h1 class="card-title">Svi korisnici</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Redni broj</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Adresa</th>
                    <th>Uloga</th>
                    <th>Status</th>
                    <th>Aktivnost</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $key => $user)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>@if($user->role == 'head_admin')
                        Head admin
                        @elseif($user->role == 'admin')
                        Admin
                        @else
                        Korisnik
                        @endif
                    </td>
                    <td>@if($user->status == 'active')
                        <a href="#" class="badge rounded-pill bg-success" disabled style="cursor: default;">aktivan</a></td>
                        @else
                        <a href="#" class="badge rounded-pill bg-danger" disabled style="cursor: default;">neaktivan</a></td>
                        @endif
                    <td>
                        <a href="{{ route('head_admin.edit_user', $user->id) }}" class="btn btn-info" title="Uredi"><i class="fa fa-pen"></i></a>
                        <a href="{{ route('head_admin.delete_user', $user->id) }}" class="btn btn-danger" id="delete" title="Izbriši"><i class="fa fa-trash-alt"></i></a>
                        @if($user->status == 'inactive')
                            <a href="{{ route('head_admin.activate_user', $user->id) }}" class="btn btn-warning" title="Aktiviraj korisnika"><i class="fa fa-check-circle"></i></a>
                        @else
                            <a href="{{ route('head_admin.deactivate_user', $user->id) }}" class="btn btn-warning" title="Deaktiviraj korisnika"><i class="fa fa-times-circle"></i></a>
                        @endif
                        
                    </td>
                  </tr>       
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Redni broj</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Adresa</th>
                    <th>Uloga</th>
                    <th>Status</th>
                    <th>Aktivnost</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection