@extends('home')

@section('container')

@home
    @slot('titulo_header','Catálogo de Usuarios')
    @slot('contenido')
        <div class="col-md-12">
            @catalogo
                @slot('body_catalogo')
                        @include('shared.user.__user_list')
                @endslot
            @endcatalogo
        </div>
    @endslot
@endhome

@endsection
