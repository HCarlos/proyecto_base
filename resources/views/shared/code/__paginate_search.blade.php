<div class="row bg-light">
    <div class="col-sm-4">
        <div class="app-search">
            <form method="get" action="{{ route('listUsers') }}" class="form-inline">
                <div class="input-group">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
                    <span class="mdi mdi-magnify"></span>
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--<div class="btn-group drop-roles">--}}
        {{--<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--Roles--}}
        {{--</button>--}}
        {{--<div class="drop-menu roles-list">--}}
            {{--@foreach($roles as $role)--}}
                {{--<div class="form-group form-check">--}}
                    {{--<input name="roles[]"--}}
                           {{--type="checkbox"--}}
                           {{--class="form-check-input"--}}
                           {{--id="role_{{ $role->id }}"--}}
                           {{--value="{{ $role->id }}"--}}
                            {{--{{ $checkedRoles->contains($role->id) ? 'checked' : '' }}>--}}
                    {{-->--}}
                    {{--<label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="col-sm-8">
        <nav aria-label="Page navigation example" style="margin-top: 1.25em;">
            {{ $items->onEachSide(1)->links() }}
        </nav>
    </div>
</div>
