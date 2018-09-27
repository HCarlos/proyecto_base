<div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="dt-buttons btn-group">
                <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><span>Copy</span></button>
                <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="datatable-buttons" type="button"><span>Print</span></button>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            @include('shared.code.__paginate_search')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table  id="{{ $tableName}}" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info" style="width: 100%;" width="100%">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 137.8px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                        <th class="sorting" tabindex="1" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 212.8px;" aria-label="Position: activate to sort column ascending">Username</th>
                        <th class="sorting" tabindex="2" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 212.8px;" aria-label="Position: activate to sort column ascending">Ap. Paterno</th>
                        <th class="sorting" tabindex="3" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 101.8px;" aria-label="Office: activate to sort column ascending">Ap. Materno</th>
                        <th class="sorting" tabindex="4" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 42.8px;" aria-label="Age: activate to sort column ascending">Nombre</th>
                        <th class="sorting" tabindex="5" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 91.8px;" aria-label="Start date: activate to sort column ascending">Género</th>
                        <th class="sorting" tabindex="6" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 79.8px;" aria-label="Salary: activate to sort column ascending">Roles</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr role="row" class="odd">
                        <td tabindex="0" class="sorting_1">{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->ap_paterno}}</td>
                        <td>{{$item->ap_materno}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->genero}}</td>
                        <td>
                            @foreach($item->roles as $role)
                                {{$role->name}}
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('shared.code.__submit_form')
