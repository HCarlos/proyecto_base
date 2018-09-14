<div class="form-group row mb-3">
    <label for = "username" class="col-md-3 col-form-label">Username</label>
    <div class="col-md-9">
        <input type="text" name="username" id="username" value="{{ old('username',$items->username) }}" min="1" max="999999" class="form-control" readonly />
    </div>
</div>
<div class="form-group row mb-3">
    <label for = "email" class="col-md-3 col-form-label">Email</label>
    <div class="col-md-9">
        <input type="email" name="email" id="email" value="{{ old('email',$items->email) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "ap_paterno" class="col-md-3 col-form-label">Paterno</label>
    <div class="col-md-9">
        <input type="text" name="ap_paterno" id="ap_paterno" value="{{ old('ap_paterno',$items->ap_paterno) }}" class="form-control" />
    </div>
    <label for = "ap_materno" class="col-md-3 col-form-label">Materno</label>
    <div class="col-md-9">
        <input type="text" name="ap_materno" id="ap_materno" value="{{ old('ap_materno',$items->ap_materno) }}" class="form-control" />
    </div>
    <label for = "nombre" class="col-md-3 col-form-label">Nombre</label>
    <div class="col-md-9">
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre',$items->nombre) }}" class="form-control" />
    </div>
    <label for = "rfc" class="col-md-3 col-form-label">RFC</label>
    <div class="col-md-9">
        <input type="text" name="rfc" id="rfc" value="{{ old('rfc',$items->rfc) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "razon_social" class="col-md-3 col-form-label">Razon S.</label>
    <div class="col-md-9">
        <input type="text" name="razon_social" id="razon_social" value="{{ old('razon_social',$items->razon_social) }}" class="form-control" />
    </div>
    <label for = "calle" class="col-md-3 col-form-label">Calle</label>
    <div class="col-md-9">
        <input type="text" name="calle" id="calle" value="{{ old('calle',$items->calle) }}" class="form-control" />
    </div>
    <label for = "num_ext" class="col-md-3 col-form-label">Num Ext</label>
    <div class="col-md-9">
        <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext',$items->num_ext) }}" class="form-control" />
    </div>
    <label for = "num_int" class="col-md-3 col-form-label">Num Int</label>
    <div class="col-md-9">
        <input type="text" name="num_int" id="num_int" value="{{ old('num_int',$items->num_int) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia',$items->colonia) }}" class="form-control" />
    </div>
    <label for = "localidad" class="col-md-3 col-form-label">Localidad</label>
    <div class="col-md-9">
        <input type="text" name="localidad" id="localidad" value="{{ old('localidad',$items->localidad) }}" class="form-control" />
    </div>
    <label for = "estado" class="col-md-3 col-form-label">Estado</label>
    <div class="col-md-9">
        <input type="text" name="estado" id="estado" value="{{ old('estado',$items->estado) }}" class="form-control" />
    </div>
    <label for = "pais" class="col-md-3 col-form-label">País</label>
    <div class="col-md-9">
        <input type="text" name="pais" id="pais" value="{{ old('pais',$items->pais) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "email1" class="col-md-3 col-form-label">E-Alt 1</label>
    <div class="col-md-9">
        <input type="email" name="email1" id="email1" value="{{ old('email1',$items->email1) }}" class="form-control" />
    </div>
    <label for = "email2" class="col-md-3 col-form-label">E-Alt 2</label>
    <div class="col-md-9">
        <input type="email" name="email2" id="email2" value="{{ old('email2',$items->email2) }}" class="form-control" />
    </div>
    <label for = "cel1" class="col-md-3 col-form-label">Cel Alt 1</label>
    <div class="col-md-9">
        <input type="text" name="cel1" id="cel1" value="{{ old('cel1',$items->cel1) }}" class="form-control" />
    </div>
    <label for = "cel2" class="col-md-3 col-form-label">Cel Alt 2</label>
    <div class="col-md-9">
        <input type="text" name="cel2" id="cel2" value="{{ old('cel2',$items->cel2) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "tel1" class="col-md-3 col-form-label">Tel Alt 1</label>
    <div class="col-md-9">
        <input type="text" name="tel1" id="tel1" value="{{ old('tel1',$items->tel1) }}" class="form-control" />
    </div>
    <label for = "tel2" class="col-md-3 col-form-label">Tel Alt 2</label>
    <div class="col-md-9">
        <input type="text" name="tel2" id="tel2" value="{{ old('tel2',$items->tel2) }}" class="form-control" />
    </div>
    <label for = "cp" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-9">
        <input type="text" name="cp" id="cp" value="{{ old('cp',$items->cp) }}" class="form-control" />
    </div>
    <label for = "curp" class="col-md-3 col-form-label">CURP</label>
    <div class="col-md-9">
        <input type="text" name="curp" id="curp" value="{{ old('curp',$items->curp) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "lugar_nacimiento" class="col-md-3 col-form-label">Lugar N</label>
    <div class="col-md-9">
        <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" value="{{ old('lugar_nacimiento',$items->lugar_nacimiento) }}" class="form-control" />
    </div>
    <label for = "fecha_nacimiento" class="col-md-3 col-form-label">Fecha N</label>
    <div class="col-md-9">
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento',$items->fecha_nacimiento) }}" class="form-control" />
    </div>
    <label for = "genero" class="col-md-3 col-form-label">Género</label>
    <div class="col-md-9">
        {{ Form::select('genero', array('1'=>'Hombre', '0'=>'Mujer'), trim($items->genero), ['id' => 'genero','class' => 'form-control']) }}
    </div>
    <label for = "ocupacion" class="col-md-3 col-form-label">Ocupación</label>
    <div class="col-md-9">
        <input type="text" name="ocupacion" id="ocupacion" value="{{ old('ocupacion',$items->ocupacion) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "domicilio" class="col-md-3 col-form-label">Domicilio</label>
    <div class="col-md-11">
        <textarea rows="4" name="domicilio" id="domicilio" class="col-md-12">{{ old('domicilio',$items->domicilio) }}</textarea>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "celular" class="col-md-3 col-form-label">Celular</label>
    <div class="col-md-4">
        <input type="text" name="celular" id="celular" value="{{ old('celular',$items->celular) }}" class="form-control" />
    </div>
    <label for = "telefono" class="col-md-3 col-form-label">Teléfono</label>
    <div class="col-md-4">
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono',$items->telefono) }}" class="form-control" />
    </div>
    <label for = "iduser_ps" class="col-md-3 col-form-label">Id PS</label>
    <div class="col-md-1">
        <input type="text" name="iduser_ps" id="iduser_ps" value="{{ old('iduser_ps',$items->iduser_ps) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "celular" class="col-md-3 col-form-label">Roles</label>
    <div class="col-md-11">
        @foreach($items->roles as $role)
            <span class="badge">{{ $role->name }}</span>
        @endforeach
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "celular" class="col-md-3 col-form-label">Permisos</label>
    <div class="col-md-11">
        @foreach($items->permissions as $permission)
            <span class="badge">{{ $permission->name }}</span>
        @endforeach
    </div>
</div>

<hr>
