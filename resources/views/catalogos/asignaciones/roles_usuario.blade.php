@extends('home')

@section('container')

    @asignaciones
        @slot('titleLeft0') {{$titleLeft0}} @endslot
        @slot('urlAsigna') {{$urlAsigna}} @endslot
        @slot('urlElimina') {{$urlElimina}} @endslot
        @slot('urlRegresa') {{$urlRegresa}} @endslot

        @slot('list0')
            {{ Form::select('listEle', $listEle, '', ['multiple' => 'multiple','class'=>'listEle form-control lista-fill-75hv']) }}
        @endslot
        @slot('usuario0')
            {{ Form::select('listTarget', $listTarget, $Id, ['id' => $urlRegresa,'size' => '1', 'class'=>'listTarget form-control']) }}
        @endslot
        @slot('target0')
            {{ Form::select('lstAsigns', $lstAsigns, '', ['multiple' => 'multiple', 'class'=>'lstAsigns form-control lista-fill-75hv']) }}
        @endslot
    @endasignaciones

@endsection
