@extends('head_admin.head_admin_dashboard')
@section('head_admin')

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
                    <th>ID korisnika</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Poruka</th>
                    <th>Status</th>
                    <th>Odgovorio/la</th>
                    <th>Aktivnost</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($messages as $key => $message)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>@if($message->user_id)
                            {{ $message->user_id }}
                        @else
                            Neregistrovan
                        @endif
                    </td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->text }}</td>
                    <td>@if($message->status)
                        <a href="#" class="badge rounded-pill bg-success" disabled style="cursor: default;">Odgovoreno</a></td>
                        @else
                        <a href="#" class="badge rounded-pill bg-danger" disabled style="cursor: default;">Na čekanju</a></td>
                        @endif
                    </td>
                    <td>
                        @if($message->answered_by)
                            {{ $message->answered_by }}
                        @else
                            Nije odgovoreno
                        @endif

                    </td>
                    <td>
                        @if($message->status == '1')
                            <a href="#" class="btn btn-success" title="Rezervacija je odobrena" disabled><i class="fa fa-check"></i></a></td>
                        @else
                            <a href="{{ route('head_admin.answer_message', $message->id) }}" class="btn btn-info" title="Odobri">Odgovori</a></td>
                        @endif
                  </tr>       
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>ID korisnika</th>
                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Poruka</th>
                    <th>Status</th>
                    <th>Odgovorio/la</th>
                    <th>Aktivnost</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection