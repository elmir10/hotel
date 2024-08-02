@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">

    <div class="card">
    <div class="col-sm-12" style="margin: 0.4rem;">
        <h1>Odgovorite na poruku</h1>
    </div>
    <hr style="background-color:gray;">
        <div class="card-body p-4">
            <hr/>
            <form method="post" action="{{ route('admin.send_answer') }}">
            @csrf

            <input type="hidden" value="{{ $message_id }}" name="id">

            <div class="form-body mt-4">
                
                <div class="form-group mb-3">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Unesite sadržaj poruke
                                </h3>
                            </div>
                            <div class="card-body">
                                <textarea id="summernote" name="answer"></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('answer')" class="text-danger" style="list-style-type: none; margin-left: -25px;"/>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                    <input type="submit" class="btn btn-primary px-4" value="Odgovori" />
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

@endsection