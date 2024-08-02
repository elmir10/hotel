@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 style="margin-top: 0.8rem;">Uspješno ste unijeli podatke sobe, sada priložite fotografije.</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card-body" style="display: block;">
                        <img id="showImage" class="img-fluid pad" src="{{ url('upload/no_image.jpg') }}" alt="Photo" width="250px">
                </div>
            </div>
            <div class="col-md-9">
                <form method="post" action="{{ route('head_admin.store.room_image') }}" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" value="{{$id}}" name="room_id">

                    <div class="form-group">
                        <label for="exampleInputFile">Priložite udarnu fotografiju</label>
                        <div class="input-group">
                                <input type="file" id="photo" class="custom-file-input" name="main_photo" accept="image/*" content="Pretrazi">
                                <label class="custom-file-label" for="exampleInputFile">Izaberite fotografiju</label>
                        </div>
                        <x-input-error :messages="$errors->get('main_photo')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Priložite ostale fotografije</label>
                        <div class="input-group">
                                <input type="file" id="other_photos" class="custom-file-input" name="other_photos[]" accept="image/*" content="Pretrazi" multiple> 
                                <label class="custom-file-label" for="exampleInputFile">Izaberite fotografije</label>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="alert alert-danger" style="list-style-type: none;"/>
                    </div>
                    <div class="row" id="preview_img">

                    </div>
                    <br>
                        <input type="submit" value="Dodaj fotografije" class="btn btn-primary">
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

<script> 
$(document).ready(function(){
  $('#other_photos').on('change', function(){ 
    if (window.File && window.FileReader && window.FileList && window.Blob) 
    {
      var data = $(this)[0].files; 
      $('#preview_img').empty();

      $.each(data, function(index, file){ 
        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ 
          var fRead = new FileReader(); 
          fRead.onload = (function(file){ 
            return function(e) {
              var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80); 
              $('#preview_img').append(img); 
            };
          })(file);
          fRead.readAsDataURL(file); 
        }
      });

    }else{
      alert("Vaš pretraživač ne podržava File API!"); 
    }
  });
});
</script>




@endsection
