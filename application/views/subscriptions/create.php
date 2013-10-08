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
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('subscriptions/create', $attributes); ?>
        <legend>Crear subscripcion</legend>                
        <input id="dp1" name="start_date" type="text" placeholder="Fecha de Inicio" style="cursor:pointer;" value="<?php echo date('d-m-Y'); ?>">                
        <input name="clients_client_id" type="hidden" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } else{ echo $data['clients_client_id']; }?>">        
        <select name="subscription_types_subscription_type_id">
            <?php foreach ($data['subscription_types'] as $subscriptionType) { ?>
                <option value="<?php echo $subscriptionType->subscription_type_id ?>"><?php echo $subscriptionType->description ?></option>
            <?php } ?>
        </select>
        <label class="checkbox">            
            <input type="checkbox" name="paid" value="1"> <b>Pagada?</b>
        </label>
        <br>
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
            <a href="<?php echo base_url('subscriptions/listClientSubscriptions?client_id='.$data['clients_client_id']) ?>" class="btn btn-primary">Aceptar</a>        
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
<script>
    $(function(){
        checkin = $('#dp2').datepicker({
            format: 'dd-mm-yyyy'            
        }).on('changeDate', function(ev) {         
          checkin.datepicker('hide');
        });
    });
</script>