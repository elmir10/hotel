@extends('head_admin.head_admin_dashboard')
@section('head_admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">

    <div class="card">
    <div class="col-sm-12" style="margin: 0.4rem;">
        <h1>Dodajte sobu</h1>
    </div>
    <hr style="background-color:gray;">
        <div class="card-body p-4">
            <h5 class="card-title">Unesite podatke sobe</h5>
            <hr/>
            <form method="post" id="myForm" action="{{ route('head_admin.store.room') }}">
            @csrf

            <div class="form-body mt-4">
            <div class="row">
                <div class="col-lg-8">
                <div class="border border-3 p-4 rounded">
                <div class="form-group mb-3">
                    <label class="form-label">Naziv</label>
                    <input type="text" name="name" class="form-control" placeholder="Unesite naziv sobe">
                    <x-input-error :messages="$errors->get('name')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Broj</label>
                    <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="number" class="form-control visually-hidden" placeholder="Unesite broj sobe">
                    <x-input-error :messages="$errors->get('number')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                </div>
                <div class="form-group mb-3">
                    <div class="form-group">
                        <label>Tip</label>
                        <select name="type_id" class="form-control" id="inputCollection">
                        @foreach($types as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Površina</label>
                    <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="size" class="form-control visually-hidden" placeholder="Unesite površinu">
                    <x-input-error :messages="$errors->get('size')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                </div>
                
                <div class="form-group mb-3">
                <label class="form-label">Unesite opis sobe</label>
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Opis
                                </h3>
                            </div>
                            <div class="card-body">
                                <textarea id="summernote" name="description"></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="text-danger" style="list-style-type: none; margin-left: -25px;"/>
                        </div>
                    </div>
                </div>
                               
                </div>
                </div>
                <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                    <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Cijena</label>
                        <input type="text" name="price" class="form-control" id="inputPrice" placeholder="00.00">
                        <x-input-error :messages="$errors->get('price')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputCompareatprice" class="form-label">Kapacitet</label>
                        <input type="text" pattern="[0-9]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="capacity" class="form-control visually-hidden" placeholder="Unesite broj ljudi">
                        <x-input-error :messages="$errors->get('capacity')" class="text-danger" style="list-style-type: none; margin-left: -35px;"/>
                        </div>
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="wifi" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Wi-fi</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="air_condition" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Klima</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="balcony" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Terasa</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="sea_view" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Pogled na more</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="minibar" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Minibar</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="strongbox" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Sef</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="worktable" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Radni sto</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="tv" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">TV</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="sofa" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Fotelja</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="parking" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Parking</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="spa_and_wellness" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Spa i wellness</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="breakfast" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Doručak</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="no_smoking" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Za nepušače</label>
                                    </div>    
                                </div>
                                <div class="col md-6">
                                    <div class="form-check">
                                        <input name="crib" type="checkbox" class="form-check-input" value="1" >
                                        <label class="form-check-label">Krevetac</label>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="d-grid">
                            <input type="submit" class="btn btn-primary px-4" value="Dodaj sobu" />
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
            </div><!--end row-->
           </div>
        </form>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                number: {
                    required: true,
                },
                size: {
                    required: true,
                },
                description: {
                    required: true,
                },
                price: {
                    required: true,
                },
                capacity: {
                    required: true,
                },
                
            },
            messages: {
                name: {
                    required: 'Molimo unesite ime sobe.',
                    minlength: 'Ime mora imati vise od 2 slova.'
                },
                number: {
                    required: 'Molimo unesite broj sobe.'
                },
                size: {
                    required: 'Molimo unesite površinu sobe.',
                },
                description: {
                    required: 'Molimo unesite opis sobe.',
                },
                price: {
                    required: 'Molimo unesite cijenu (jedna noć) sobe.',
                },
                capacity: {
                    required: 'Molimo unesite broj ljudi koji mogu provesti vrijeme u sobi.',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        })
    })
</script>


@endsection