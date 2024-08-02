@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<section class="content">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <div class="card">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Izmijeni podatke</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('head_admin.update_user') }}">
                @csrf

                <input type="hidden" value="{{ $data->id }}" name="id">

                <div class="card-body">
                  <div class="form-group">
                    <label>Ime</label>
                    <input type="text" class="form-control" name="name" placeholder="Unesite ime" value="{{ $data->name }}">
                    <x-input-error :messages="$errors->get('name')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite email" value="{{ $data->email }}" disabled>
                  </div>
                  <div class="form-group">
                    <label>Telefon</label>
                    <input type="text" class="form-control" name="phone" placeholder="Unesite broj telefona" value="{{ $data->phone }}">
                    <x-input-error :messages="$errors->get('phone')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                  </div>
                  <div class="form-group">
                    <label>Adresa</label>
                    <input type="text" class="form-control" name="address" placeholder="Unesite adresu" value="{{ $data->address }}">
                    <x-input-error :messages="$errors->get('address')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                  </div>
                  <div class="form-group">
                        <label>Uloga</label>
                        <select name="role" class="form-control" id="inputCollection">
                            <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>Korisnik</option>
                            <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="head_admin" {{ $data->role == 'head_admin' ? 'selected' : '' }}>Head admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                </div>
                </div>

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