@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu email</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Se ha enviado un correo de restauración de cuenta.
                        </div>
                    @endif



                    Before proceeding, please check your email for a verification link.
                    If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
