@if ($errors->any())
    <div class="alert alert-danger">
        <h6 class="alert alert-danger">Corrije estos errores:</h6>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
