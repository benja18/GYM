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
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'update', 'action' => '');
        ?>
        <?php echo form_open('subscriptions/update', $attributes); ?>
        <legend>Editar subscripcion</legend>      
        <input name="subscription_id" type="hidden" placeholder="Subscription Id" value="<?php if ($data['status'] == '') {echo $_GET['subscription_id']; } elseif($data['status'] != 'SubscriptionUpdated'){ echo $data['subscription']['subscription_id']; }?>">
        <input id="dp1" name="start_date" type="text" placeholder="Fecha de Inicio" readonly="true" style="cursor:pointer;" value="<?php if ($data['status'] != 'SubscriptionUpdated') {echo $data['subscription']['start_date']; }?>">
        <input id="dp2" name="end_date" type="text" placeholder="Fecha de Fin" readonly="true" style="cursor:pointer;" value="<?php if ($data['status'] != 'SubscriptionUpdated') {echo $data['subscription']['end_date']; }?>">
        <label class="checkbox">
            <input type="checkbox" name="paid" value="1" <?php if ($data['status'] != 'SubscriptionUpdated' && $data['subscription']['paid'] == 1) {echo 'checked'; }?>> Pagada?
        </label>
        <input name="price" type="text" placeholder="Precio" value="<?php if ($data['status'] != 'SubscriptionUpdated') {echo $data['subscription']['price']; }?>">
        <input name="clients_client_id" type="hidden" value="<?php if ($data['status'] != 'SubscriptionUpdated') {echo $data['subscription']['clients_client_id']; }?>">                
        <select name="subscription_types_subscription_type_id">
            <?php foreach ($data['subscription_types'] as $subscriptionType) { ?>
                <option value="<?php echo $subscriptionType->subscription_type_id ?>" <?php if ($data['subscription']['subscription_types_subscription_type_id'] == $subscriptionType->subscription_type_id){echo 'selected';}?>><?php echo $subscriptionType->description ?></option>
            <?php } ?>
        </select>
        <br><br>        
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'SubscriptionUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Subscripcion editada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('subscriptions/listClientSubscriptions?client_id='.$data['clients_client_id']) ?>" class="btn btn-primary">Aceptar</a>        
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