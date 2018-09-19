@extends('home')

@section('container')

@home
    @slot('titulo_header','Mi perfil')
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
                    <form method="POST" action="{{ route('Edit') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('shared.user.__user_edit')

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            {{--<a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a>--}}
                        </div>
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome

@endsection
