
$(document).ready(function() {

    // var pathAssign   = ['/asign_role_user/','/asign_permission_role/'];0
    // var pathUnAssign = ['/unasign_role_user/','/unasign_permission_role/'];

    if ( $(".dataTable").length > 0 ){

        var nCols = $(".dataTable").find("tbody > tr:first td").length;
        var aCol = [];

        for (i = 0; i < nCols - 1; i++) {aCol[i] = {};}
        aCol[nCols - 1] = {"sorting": false};

        $(".dataTable").DataTable({
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

    }


    if ( $(".removeItemList").length > 0  ){
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

    if ( $(".btnFullModal").length > 0  ){
        $(".btnFullModal").on("click", function (event) {
            event.preventDefault();
            $("#modalFull .modal-content").empty();
            $("#modalFull .modal-content").html('<div class="fa-2x m-2"><i class="fa fa-cog fa-spin"></i> Cargado datos...</div>');
            $("#modalFull").modal('show');
            var Url = event.currentTarget.id;
            $(function () {
                $.ajax({
                    method: "get",
                    url: Url
                })
                    .done(function (response) {
                        $("#modalFull .modal-content").html(response);
                    });
            });
        });
    }

    if ( $(".listTarget").length > 0  ){
        $(".listTarget").on('change', function(event) {
            event.preventDefault();
            window.location.href = '/'+this.id+'/'+$(this).val();
        });
    }

    if ( $(".btnAsign0").length > 0  ){
        $(".btnAsign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var urlAsigna = IdArr[0];
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
            var Url = '/'+urlAsigna+'/'+y+'/'+x;
            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        window.location.href = response.mensaje;
                    });
            });
        });
    }

    if ( $(".btnUnasign0").length > 0  ){
        $(".btnUnasign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var urlElimina = IdArr[0];
            var urlRegresa = IdArr[1];
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
            var Url = '/'+urlElimina+'/'+y+'/'+z;
            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        window.location.href = response.mensaje;
                    });
            });

        });
    }

    // if ( $("#btnRefreshNavigator") ){
    //     $("#btnRefreshNavigator").on('click', function(event) {
    //         event.preventDefault();
    //         window.location.reload();
    //     });
    // }

    // if ( $('#descripcion_pedido') ) {
    //     $('#descripcion_pedido').val( $('#paquete_id').find(':selected').text() );
    //     $('#paquete_id').on('change',function(event){
    //         $('#descripcion_pedido').val( $('#paquete_id').find(':selected').text() );
    //     });
    // }

});
