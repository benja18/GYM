<div class="row-fluid">    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'PriceError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes ingresar un precio valido.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar todos los campos.</p>
            </div>
        <?php } ?>
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('expenses/update', $attributes); ?>
        <legend>Ediar gasto</legend>
        <input name="expense_id" type="hidden" placeholder="Expense Id" value="<?php if ($data['status'] == '') {echo $_GET['expense_id']; } else{ echo $data['expense_id']; }?>">
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'ExpenseUpdated') {echo $data['expense']['name']; }?>">
        <input name="value" type="text" placeholder="Precio" value="<?php if ($data['status'] != 'ExpenseUpdated') {echo $data['expense']['value']; }?>">
        <input id="dp1" name="date" type="text" placeholder="Fecha" style="cursor:pointer;" value="<?php if ($data['status'] != 'ExpenseUpdated') {echo date('d-m-Y',  strtotime($data['expense']['date'])); }?>">                       
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'ExpenseUpdated') { ?>
    <div class="modal hide fade in" style="display: block; ">
        <div class="modal-header">        
            <h3>Mensaje</h3>
        </div>
        <div class="modal-body">
            <h4>Gasto actualizado</h4>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('expenses/listExpenses') ?>" class="btn btn-primary">Aceptar</a>        
        </div>
    </div>
    <div class="modal-backdrop fade in"></div>
<?php } ?>

<script>
    $(function(){
        checkin = $('#dp1').datepicker({
            format: 'dd-mm-yyyy'            
        }).on('changeDate', function(ev) {         
          checkin.datepicker('hide');
        });
    });
</script>