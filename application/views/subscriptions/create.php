<div class="row-fluid">
    <br><br>    
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
        //echo validation_errors();
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('subscriptions/create', $attributes); ?>
        <legend>Crear subscripcion</legend>                
        <input id="dp1" name="start_date" type="text" placeholder="Fecha de Inicio" readonly="true" style="cursor:pointer;">
        <input id="dp2" name="end_date" type="text" placeholder="Fecha de Fin" readonly="true" style="cursor:pointer;">
        <label class="checkbox">
            <input type="checkbox" name="paid" value="1"> Pagada?
        </label>
        <input name="price" type="text" placeholder="Precio">
        <input name="clients_client_id" type="hidden" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } else{ echo $data['clients_client_id']; }?>">        
        <select name="subscription_types_subscription_type_id">
            <?php foreach ($data['subscription_types'] as $subscriptionType) { ?>
                <option value="<?php echo $subscriptionType->subscription_type_id ?>"><?php echo $subscriptionType->description ?></option>
            <?php } ?>
        </select>
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'SubscriptionInserted') { ?>
    <div class="modal hide fade in" style="display: block; ">
        <div class="modal-header">        
            <h3>Mensaje</h3>
        </div>
        <div class="modal-body">
            <h4>Subscripcion creada</h4>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
        </div>
    </div>
    <div class="modal-backdrop fade in"></div>
<?php } ?>

<script>
    $(function() {
        $('#dp1').datepicker({
            format: 'yyyy-mm-dd'
        });

    });

</script>
<script>
    $(function() {
        $('#dp2').datepicker({
            format: 'yyyy-mm-dd'
        });

    });

</script>