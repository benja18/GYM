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
    function sendId(expense_id) {
        document.getElementById('modal-footer').innerHTML = "<a href=\"<?php echo base_url('expenses/delete?expense_id=') ?>" + expense_id + "\" class=\"btn btn-primary\">Si</a><a class=\"btn\" data-dismiss=\"modal\">No</a>"

        $('#modal-delete').modal("show");
    }
</script>
<div class="row span12 offset2">
    <legend>Gastos</legend>   
    <div class="row span12">
        <?php
            $attributes = array('role' => 'form', 'class' => 'form-inline', 'id' => 'myform', 'name' => 'create');
            echo form_open('expenses/listExpenses', $attributes);
        ?>
        <h5>Buscar por fecha</h5>                
        <input id="dp1" class="input-small" name="start_date" type="text" placeholder="Inicio" style="cursor:pointer;">
        <input id="dp2" class="input-small" name="end_date" type="text" placeholder="Fin" style="cursor:pointer;">
        <button type="submit" class="btn right">Buscar</button>        
        <br><br>

        </form>    
        <?php if ($data['status'] == 'ShowTable') { ?>
        </div>
        <table class="table table-bordered" id="example">
            <thead>
            <tr>       
                <th>Nombre</th>
                <th>Gasto</th>
                <th>Fecha</th>                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['expenses'])) {
                foreach ($data['expenses'] as $expense) {
                    ?>
                    <tr>                        
                        <td><strong><?php echo $expense->name ?></strong></td>
                        <td><strong><?php echo '$'.$expense->value ?></strong></td>                        
                        <td><strong><?php echo date('d-m-Y',  strtotime($expense->date)); ?></strong></td>                        
                        <td>
                            <a class="btn btn-primary btn-mini" href="<?php echo base_url('expenses/update?expense_id=') . $expense->expense_id ?>"><i class="icon-edit  icon-white"></i> Editar</a>
                            <a class="btn btn-danger btn-mini" onclick="sendId(<?php echo $expense->expense_id ?>)"><i class="icon-remove icon-white"></i> Eliminar</a>                            
                        </td>                                                
                    </tr>
    <?php } } ?>
        </tbody>
    </table>
        <?php } ?>
</div>
<div class="modal hide" id="modal-delete">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <p>¿Está seguro que desea eliminar el gasto?</p>
    </div>
    <div id="modal-footer" class="modal-footer">        
    </div>
</div>
<script>
    $(function(){
        $('#dp1').datepicker({
            format: 'dd-mm-yyyy'            
        });
    });
</script>
<script>
    $(function(){
        $('#dp2').datepicker({
            format: 'dd-mm-yyyy'            
        });
    });
</script>