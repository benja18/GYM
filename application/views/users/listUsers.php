<div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <div class="row">
        <div class="span6">
            <div id="example_length" class="dataTables_length">
                <label><select size="1" name="example_length" aria-controls="example">
                        <option value="10" selected="selected">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> 
                    registros por pagina
                </label>
            </div>
        </div>
        <div class="span6">
            <div class="dataTables_filter" id="example_filter">
                <label>Buscar: <input type="text" aria-controls="example"></label>
            </div>
        </div>
    </div>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable DTTT_selectable" id="example" width="100%" aria-describedby="example_info" style="width: 100%;">
	<thead>
		<tr role="row">
                    <th width="10%" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 271px;" aria-sort="ascending" aria-label="Browser: activate to sort column descending">Nombre de Usuario</th>
                    <th width="20%" class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 175px;" aria-label="Rendering engine: activate to sort column ascending">Accion</th>                    
                </tr>
	</thead>
	<tfoot>
		
	</tfoot>
<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php foreach ($data['users'] as $user){?>
    <tr id="row_10" class="even">
        <td class=" sorting_1"><?php echo $user->username ?></td>
        <td class=""><a class="btn btn-primary" href="<?php echo base_url('users/update?user_id=').$user->user_id ?>"><i class="icon-edit  icon-white"></i> Editar</a> <a class="btn btn-danger"><i class="icon-remove icon-white"></i> Eliminar</a></td>        
    </tr>
    <?php }?>
</tbody>
    </table>
    <div class="row-fluid">
        <div class="span6">
            <div class="dataTables_info" id="example_info">Mostrnado 1 a 10 de 57 registros</div>
            
        </div>
        <div class="span6">
            <div class="dataTables_paginate paging_bootstrap pagination">
                <ul>
                    <li class="prev disabled"><a href="#">← Anterior</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="next"><a href="#">Siguiente → </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>