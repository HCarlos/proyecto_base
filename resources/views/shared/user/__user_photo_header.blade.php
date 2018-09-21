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
        <img src="{{ asset('storage/'.Auth::user()->root.Auth::user()->filename_png)  }}" class="mr-3 d-none d-sm-block col-md-12"/>
        <a href="{{ route('quitarArchivoProfile/')  }}" class="btn btn-icon btn-light red mi-imagen-bajo-derecha" >
            <i class="mdi mdi-delete-empty mdi-18px"></i>
        </a>
    @endif
@endslot
@endcard
