@extends('admin.admin_dashboard')
@section('admin')

<section class="content">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ (!empty($data->photo)) ? url('upload/head_admin_images/'.$data->photo) : url('upload/no_image.jpg') }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $data->name }}</h3>
                <p class="text-muted text-center">{{ $data->email }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Izmijeni podatke</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('admin.profile.store') }}">
                @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label>Ime</label>
                    <input type="text" class="form-control" name="name" placeholder="Unesite ime" value="{{ $data->name }}">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite email" value="{{ $data->email }}" disabled>
                  </div>
                  <div class="form-group">
                    <label>Telefon</label>
                    <input type="text" class="form-control" name="phone" placeholder="Unesite broj telefona" value="{{ $data->phone }}">
                  </div>
                  <div class="form-group">
                    <label>Adresa</label>
                    <input type="text" class="form-control" name="address" placeholder="Unesite adresu" value="{{ $data->address }}">
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