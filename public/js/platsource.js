
$(document).ready(function() {

    var pathAssign   = ['/asign_role_user/','/asign_permission_role/'];
    var pathUnAssign = ['/unasign_role_user/','/unasign_permission_role/'];

    var nCols = $('#tblCat').find("tbody > tr:first td").length;
    var aCol = [];

    for (i = 0; i < nCols - 1; i++) {aCol[i] = {};}
    aCol[nCols - 1] = {"sorting": false};

    var table = $('#tblCat').DataTable({
        searching: false,
        paging: false,
        info: true,
        "pageLength": 50,
        "order": [[ 0, "desc" ]],
        "language": {
            "info": "Mostrando página _PAGE_ de _PAGES_"
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "aoColumns": aCol
    });


    if ( $(".removeItemList") ){
        $('.removeItemList').on('click', function(event) {
            event.preventDefault();
            var aID = event.currentTarget.id.split('-');
            var x = confirm("Desea eliminar el registro: "+aID[1]);

            if (!x){
                return false;
            }

            var Url = '/'+aID[0]+'/'+aID[1];

            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        if (response.data == 'OK'){
                            alert(response.mensaje);
                            window.location.reload();
                        }else{
                            alert(response.mensaje);
                        }
                    })
            });
        });
    }

    if ( $(".listTarget") ){
        $(".listTarget").on('change', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var Ida    = IdArr[1];
            var IdUser = $(this).val();
            window.location.href = '/list_left_config/'+Ida+'/'+IdUser+'/';
        });
    }

    if ( $(".btnAsign0") ){
        $(".btnAsign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var Cat_Id = IdArr[1];
            var IdUser = IdArr[2];
            var x = $('.listEle option:selected').val();
            var y = $('select[name="listTarget"] option:selected').val();
            if (isUndefined(x)){
                alert("Seleccione una opción disponible");
                return false;
            }else{
                x='';
                $(".listEle option:selected").each(function () {
                    x += $(this).val() + "|";
                });

            }
            if (isUndefined(y) || y <= 0){
                alert("Seleccione un elemento");
                return false;
            }
            var Url = pathAssign[Cat_Id]+y+'/'+x+'/'+Cat_Id;


            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        window.location.href = '/list_left_config/'+Cat_Id+'/'+y;
                    });
            });

        });
    }

    if ( $(".btnUnasign0") ){
        $(".btnUnasign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var Cat_Id = IdArr[1];
            var z = $('.lstAsigns option:selected').val();
            var y = $('select[name="listTarget"] option:selected').val();
            if (isUndefined(z)){
                alert("Seleccione una opción disponible");
                return false;
            }else{
                z='';
                $(".lstAsigns option:selected").each(function () {
                    z += $(this).val() + "|";
                });
            }
            if (isUndefined(y) || y <= 0){
                alert("Seleccione un elemento");
                return false;
            }
            var Url = pathUnAssign[Cat_Id]+y+'/'+z+'/'+Cat_Id;
            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        window.location.href = '/list_left_config/'+Cat_Id+'/'+y;
                    });
            });

        });
    }

    if ( $("#btnRefreshNavigator") ){
        $("#btnRefreshNavigator").on('click', function(event) {
            event.preventDefault();
            window.location.reload();
        });
    }

    if ( $('#descripcion_pedido') ) {
        $('#descripcion_pedido').val( $('#paquete_id').find(':selected').text() );
        $('#paquete_id').on('change',function(event){
            $('#descripcion_pedido').val( $('#paquete_id').find(':selected').text() );
        });
    }

});
