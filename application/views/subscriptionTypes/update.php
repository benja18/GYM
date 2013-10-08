<div class="row-fluid">    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar todos los campos.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'InvalidDays') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>La cantidad de dias debe ser un numero.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'InvalidPrice') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El precio debe ser un numero.</p>
            </div>
        <?php } ?>
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'update', 'action' => '');
        ?>
        <?php echo form_open('subscriptionTypes/update', $attributes); ?>
        <legend>Editar tipo de subscripcion</legend>
        <input name="subscription_type_id" type="hidden" placeholder="Subscription Type Id" value="<?php if ($data['status'] == '') {echo $_GET['subscription_type_id']; } else{ echo $data['subscription_type_id']; }?>">        
        <input name="description" type="text" placeholder="Description" value="<?php if ($data['status'] != 'SubscriptionTypeUpdated') {echo $data['description']; }?>">
        <input name="days" type="text" placeholder="Cantidad de dias" value="<?php if ($data['status'] != 'SubscriptionTypeUpdated') {echo $data['days']; }?>">
        <input name="price" type="text" placeholder="Precio" value="<?php if ($data['status'] != 'SubscriptionTypeUpdated') {echo $data['price']; }?>">
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'SubscriptionTypeUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Tipo de subscripcion editada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('subscriptionTypes/listSubscriptionTypes') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  
