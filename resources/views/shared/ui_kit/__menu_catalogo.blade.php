<div class="row bg-dark-lighten">
    <div class="col-sm-12 button-list " style="padding: 1em;">
        <a href="{{route($newItem)}}"  @isset($newWindow) target="_blank" @endisset class="btn btn-icon btn-light"> <i class="fas fa-plus"></i> </a>
        <a href="#" class="btn btn-icon btn-cafe"> <i class="fas fa-print text-white"></i> </a>
        <a href="#" class="btn btn-icon btn-orange"> <i class="fas fa-cogs text-white"></i> </a>
        <a href="#" class="btn btn-icon btn-info"> <i class="fas fa-list-ol"></i> </a>
        <a href="#" class="btn btn-icon btn-secondary"> <i class="far fa-window-restore"></i> </a>
        <a href="#" class="btn btn-icon btn-danger"> <i class="fas fa-table"></i> </a>
        <a href="#" class="btn btn-icon btn-warning"> <i class="fas fa-edit"></i> </a>
        <a href="#" class="btn btn-icon btn-dark"> <i class="fas fa-toolbox"></i> </a>

        <a href="/home" class="btn btn-icon btn-primary float-right">
            <i class="fas fa-home"></i>
        </a>
        <a href="#" class="btn btn-icon btn-success float-right"
           onclick="location.reload(); ">
            <i class="fas fa-sync-alt"></i>
        </a>
    </div>
</div>
