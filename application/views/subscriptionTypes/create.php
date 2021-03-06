<div class="row-fluid">    
    <div class="span10 offset1">
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar el campo.</p>
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
        //echo validation_errors();
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('subscriptionTypes/create', $attributes); ?>
        <legend>Crear Tipo de Susbcripcion</legend>        
        <input name="description" type="text" placeholder="Descripcion">
        <input name="days" type="text" placeholder="Cantidad de dias">
        <input name="price" type="text" placeholder="Precio">
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span2"></div>
</div>
<?php if ($data['status'] == 'SubscriptionTypeInserted') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Tipo de Subscripcion creada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('subscriptionTypes/listSubscriptionTypes') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  