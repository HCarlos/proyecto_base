@extends('home')

@section('container')

@home
    @slot('IsImage',false)
    @slot('titulo_header','Profile')
    @slot('contenido')
                    <div class="col-md-4">
                        <!-- Personal-Information -->
                        @card
                            @slot('title_card',Auth::user()->username)
                            @slot('body_card')
                                @if( Auth::user()->IsEmptyPhoto() )
                                    @if( Auth::user()->IsFemale() )
                                        <img src="{{ asset('images/web/empty_user_female.png')  }}" class="img-circle border border-white"/>
                                    @else
                                        <img src="{{ asset('images/web/empty_user_male.png')  }}" class="img-circle border border-white"/>
                                    @endif
                                @else
                                    <img src="{{ asset('archivos'.Auth::user()->root.Auth::user()->filename)  }}" class="img-circle border border-white "/>
                                @endif
                            @endslot
                        @endcard
                    </div> <!-- end col-->

                    <div class="col-md-8">
                        <!-- Chart-->
                        @card
                        @slot('title_card',Auth::user()->FullName)
                        @slot('body_card')

                            {{--@include('shared.__errors')--}}

                            <form method="POST" action="{{ url('Edit') }}">
                                @include('shared.user.__user_edit')

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                                    {{--<a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a>--}}
                                </div>
                            </form>

                        @endslot
                        @endcard

                    </div>
                    <!-- end col -->
     @endslot
@endhome

@endsection
