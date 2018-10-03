<div class="mt-4"></div>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-light text-dark " style="height: 70vh;">
            <div class="card-body">
                <strong class="panel-title">{{ $titleLeft0  }}</strong>
                {{$list0}}
            </div>
        </div> <!-- end card-->
    </div><!-- end col -->

    <div class="col-md-4">
        <!-- Portlet card -->
        <div class="card bg-default text-white " style="height: 70vh;">
            <div class="card-body">
                <div class="position-ref full-height" style="padding-top: 30vh">
                    @if (Auth::User()->hasRole('Administrator'))
                        <button type="button" class="btn btn-block btn-primary btn-rounded btnAsign0" id="{{$urlAsigna.'-'.$urlRegresa}}">
                            Agregar <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" class="btn btn-block btn-sm btn-info btn-rounded btnUnasign0" id="{{$urlElimina.'-'.$urlRegresa}}">
                            <i class="fas fa-chevron-left"></i> Quitar
                        </button>
                    @endif
                </div>
            </div>
        </div> <!-- end card-->
    </div><!-- end col -->

    <div class="col-md-4">
        <!-- Portlet card -->
        <div class="card bg-light text-white " style="height: 70vh;">
            <div class="card-body">
                {{$usuario0}}
                {{$target0}}
            </div>
        </div> <!-- end card-->
    </div><!-- end col -->
</div>
