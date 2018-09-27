<form method="get" action="{{ route('listUsers') }}" class="form-inline">
    <div class="form-group">
        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
    </div>
    <button type="submit" class="btn btn-sm btn-default"><span class="fa fa-search"></span></button>
    <nav aria-label="page navigation" style="margin-top: -1.5em" class="pull-right" >
        {{ $items->links() }}
    </nav>
</form>
