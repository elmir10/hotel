@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Sve sobe</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Redni broj</th>
                    <th>Naziv</th>
                    <th>Broj sobe</th>
                    <th>Površina</th>
                    <th>Tip</th>
                    <th>Aktivnost</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($rooms as $key => $room)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->number }}</td>
                    <td>{{ $room->size }}</td>
                    <td>{{ $room->Type->name }}</td>
                    <td>
                        <a href="{{ route('head_admin.edit.room', $room->id) }}" class="btn btn-info" title="Uredi"><i class="fa fa-pen"></i></a>
                        <a href="{{ route('head_admin.delete.room', $room->id) }}" class="btn btn-danger" id="delete" title="Izbriši"><i class="fa fa-trash-alt"></i></a>
                    </td>
                  </tr>       
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Redni broj</th>
                    <th>Naziv</th>
                    <th>Broj sobe</th>
                    <th>Površina</th>
                    <th>Tip</th>
                    <th>Aktivnost</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection