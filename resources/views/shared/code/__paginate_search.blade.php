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
    <div class="col-sm-8">
        <nav aria-label="Page navigation example" style="margin-top: 1.25em;">
            {{ $items->onEachSide(1)->links() }}
        </nav>
    </div>
</div>
