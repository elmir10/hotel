@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<section class="content">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lozinka</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <div class="card">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Unesite vrijednosti</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('head_admin.update.password') }}">
                @csrf

                @if(session('status'))
                <div class="alert alert-success" role='alert'>
                    {{session('status')}}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" role='alert'>
                    {{session('error')}}
                </div>
                @endif

                <div class="card-body">
                  <div class="form-group">
                    <label>Trenutna lozinka</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" name="old_password" placeholder="Unesite trenutnu lozinku">

                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Nova lozinka</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Unesite novu lozinku" id="new_password">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Potvrda nova lozinke</label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_passowrd_confirmation" placeholder="Potvrdite novu lozinku">
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" value="Sačuvaj izmjene" class="btn btn-primary">
                </div>
              </form>
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


@endsection