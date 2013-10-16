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
                <p>El valor debe ser un numero.</p>
            </div>
        <?php } ?>
        <?php
        //echo validation_errors();
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('debts/update', $attributes); ?>
        <legend>Editar Deuda</legend>
        <input name="debt_id" type="hidden" placeholder="Debt Id" value="<?php if ($data['status'] == '') {echo $_GET['debt_id']; } else{ echo $data['debt_id']; }?>">
        <input name="description" type="text" placeholder="Descripcion" value="<?php if ($data['status'] != 'DebtUpdated') {echo $data['description']; }?>">        
        <input name="value" type="text" placeholder="Valor" value="<?php if ($data['status'] != 'DebtUpdated') {echo $data['value']; }?>">
        <input name="client_id" type="hidden" placeholder="ClientId" value="<?php if ($data['status'] != 'DebtUpdated') {echo $data['clients_client_id']; }?>">        
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>        
    </div>
    <div class="span2"></div>
</div>
<?php if ($data['status'] == 'DebtUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Deuda actualizada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('debts/listClientDebts?debt_id=').$data['debt_id'].'&client_id='.$data['client_id'] ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  