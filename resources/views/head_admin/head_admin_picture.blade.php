@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Fotografija</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card-body" style="display: block;">
                        <img id="showImage" class="img-fluid pad" src="{{ (!empty($data->photo)) ? url('upload/head_admin_images/'.$data->photo) : url('upload/no_image.jpg') }}" alt="Photo" width="250px">
                </div>
            </div>
            <div class="col-md-9">
                <form method="post" action="{{ route('head_admin.picture.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="exampleInputFile">Priloži fotografiju</label>
                        <div class="input-group">
                                <input type="file" id="photo" class="custom-file-input" name="photo" accept="image/*" content="Pretrazi" required>
                                <label class="custom-file-label" for="exampleInputFile">Izaberite fotografiju</label>
                        </div>
                    </div>
                        <input type="submit" value="Sačuvaj izmjene" class="btn btn-primary">
                </form>
            </div>
        </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('#photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>

@endsection