<div class="row bg-light">
    <div class="col-sm-6">
        <form method="get" action="{{ route('listUsers') }}" class="form-inline" >
            <div class="app-search">
                    <div class="input-group">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
                        <span class="mdi mdi-magnify"></span>
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
            </div>

            @if ( Auth::user()->hasRole('Administrator|SysOp') )

                <div class="app-search" style="position: relative; z-index: 9999; overflow: visible;">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-info ml-2 dropdown-toggle "
                                type="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                        >
                            Roles
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-animated ">
                            @foreach($roles as $role)
                            <li class="text-left">
                                <div class="form-group ml-1 ">
                                <input name="roles[]"
                                       type="checkbox"
                                       class="form-check-input "
                                       id="role_{{ $role->id }}"
                                       value="{{ $role->id }}"
                                        {{ $checkedRoles->contains($role->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            </li>
                            @endforeach

                        </ul>

                    </div>
                </div>

            @endif

        </form>
    </div>
    <div class="col-sm-6">
        <nav aria-label="Page navigation example" style="margin-top: 1.25em;">
            {{ $items->onEachSide(1)->links() }}
        </nav>
    </div>
</div>
