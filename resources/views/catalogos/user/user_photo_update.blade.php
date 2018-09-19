@extends('home')

@section('container')

@home
    @slot('titulo_header','Mi photo')
    @slot('contenido')
        <div class="col-md-4">
            @include('shared.user.__user_photo_header')
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card',Auth::user()->FullName)
                @slot('body_card')
                    @include('shared.__errors')
                    <form method="POST" action="{{ route('subirArchivoProfile/') }}"  accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        @include('shared.user.__user_photo_update')
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-upload mdi-24px"></i>Subir imagen</button>
                        </div>
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome
{{--@section('script_extra')--}}
{{--<script src="{{asset('js/dropzone.min.js')}}"></script>--}}
{{--<script src="{{asset('js/component.fileupload.js')}}"></script>--}}

{{--@endsection--}}

@endsection
