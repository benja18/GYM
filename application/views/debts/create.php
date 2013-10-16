<div class="row-fluid">    
    <div class="span10 offset1">
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar el campo.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'InvalidValue') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>La cantidad de dias debe ser un numero.</p>
            </div>
        <?php } ?>
        <?php
        //echo validation_errors();
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('debts/create', $attributes); ?>
        <legend>Crear Deuda</legend>        
        <input name="description" type="text" placeholder="Descripcion">        
        <input name="value" type="text" placeholder="Valor">
        <input name="client_id" type="hidden" placeholder="ClientId" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } else{ echo $data['client_id']; }?>">        
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span2"></div>
</div>
<?php if ($data['status'] == 'DebtInserted') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Deuda creada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('debts/listClientDebts?client_id=').$data['client_id'] ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  