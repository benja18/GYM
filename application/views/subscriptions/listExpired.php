<!--script para la tabla-->
<script type="text/javascript" charset="utf-8">
    /* Default class modification */
    $.extend($.fn.dataTableExt.oStdClasses, {
        "sSortAsc": "header headerSortDown",
        "sSortDesc": "header headerSortUp",
        "sSortable": "header"
    });

    /* API method to get paging information */
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    }

    /* Bootstrap style pagination control */
    $.extend($.fn.dataTableExt.oPagination, {
        "bootstrap": {
            "fnInit": function(oSettings, nPaging, fnDraw) {
                var oLang = oSettings.oLanguage.oPaginate;
                var fnClickHandler = function(e) {
                    e.preventDefault();
                    if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                        fnDraw(oSettings);
                    }
                };

                $(nPaging).addClass('pagination').append(
                        '<ul>' +
                        '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                        '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                        '</ul>'
                        );
                var els = $('a', nPaging);
                $(els[0]).bind('click.DT', {action: "previous"}, fnClickHandler);
                $(els[1]).bind('click.DT', {action: "next"}, fnClickHandler);
            },
            "fnUpdate": function(oSettings, fnDraw) {
                var iListLength = 5;
                var oPaging = oSettings.oInstance.fnPagingInfo();
                var an = oSettings.aanFeatures.p;
                var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

                if (oPaging.iTotalPages < iListLength) {
                    iStart = 1;
                    iEnd = oPaging.iTotalPages;
                }
                else if (oPaging.iPage <= iHalf) {
                    iStart = 1;
                    iEnd = iListLength;
                } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                    iStart = oPaging.iTotalPages - iListLength + 1;
                    iEnd = oPaging.iTotalPages;
                } else {
                    iStart = oPaging.iPage - iHalf + 1;
                    iEnd = iStart + iListLength - 1;
                }

                for (i = 0, iLen = an.length; i < iLen; i++) {
                    // Remove the middle elements
                    $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                    // Add the new list items and their event handlers
                    for (j = iStart; j <= iEnd; j++) {
                        sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                        $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                                .insertBefore($('li:last', an[i])[0])
                                .bind('click', function(e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                    }

                    // Add / remove disabled classes from the static elements
                    if (oPaging.iPage === 0) {
                        $('li:first', an[i]).addClass('disabled');
                    } else {
                        $('li:first', an[i]).removeClass('disabled');
                    }

                    if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                        $('li:last', an[i]).addClass('disabled');
                    } else {
                        $('li:last', an[i]).removeClass('disabled');
                    }
                }
            }
        }
    });

    /* Table initialisation */
    $(document).ready(function() {
        $('#example').dataTable({
            "sDom": "<'row'<'span6'l><'span5 offset1'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ Registros por página"
            }
        });
    });
</script>
<script type="text/javascript">
    function sendId(client_id) {
        document.getElementById('modal-footer').innerHTML = "<a href=\"<?php echo base_url('clients/setClientInactive?client_id=') ?>" + client_id + "\" class=\"btn btn-primary\">Si</a><a class=\"btn\" data-dismiss=\"modal\">No</a>"

        $('#modal-delete').modal("show");
    }
</script>
<div class="row  span14 offset1">
    <legend>Clientes</legend>
    <br><br>
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>Nro Socio</th>
                <th>Nombre</th>
                <th>Apellido</th>                
                <th>Fecha de vencimiento</th>                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['clients'])) {
                foreach ($data['clients'] as $client) {
                    if(date('Y-m-d', strtotime($client->end_date)) <= date('Y-m-d', strtotime("+1 days"))){
                    ?>
                    <tr>
                        <td><strong><?php echo $client->clients_client_id ?></strong></td>
                        <td><strong><?php echo $client->name ?></strong></td>
                        <td><strong><?php echo $client->surname ?></strong></td>                        
                        <td><strong><?php if(!empty($client->end_date)){echo date('d-m-Y',  strtotime($client->end_date));} ?></strong></td>                        
                        <td>
                            <a class="btn btn-primary btn-mini span2" href="<?php echo base_url('clients/update?client_id=') . $client->clients_client_id ?>"><i class="icon-info-sign  icon-white"></i> Ver Info</a>
                            <a class="btn btn-success btn-mini span5" href="<?php echo base_url('subscriptions/create?client_id=') . $client->clients_client_id ?>"><i class="icon-plus  icon-white"></i> Renovar Subscripcion</a>
                            <a class="btn btn-danger btn-mini span3" onclick="sendId(<?php echo $client->clients_client_id ?>)"><i class="icon-download icon-white"></i> Dar de baja</a>
                        </td>                                                
                    </tr>
                    <?php }}} ?>
        </tbody>
    </table>
</div>
<div class="modal hide" id="modal-delete">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <p>¿Está seguro que desea marcar como inactivo al cliente?</p>
    </div>
    <div id="modal-footer" class="modal-footer">        
    </div>
</div>
