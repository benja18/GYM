<div class="row-fluid">    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'CiDuplicated') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Ya existe un cliente con esta cedula.</p>
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
        <?php echo form_open('clients/update', $attributes); ?>
        <legend>Editar Socio</legend>
        <input name="client_id" type="hidden" placeholder="Client Id" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } elseif($data['status'] != 'ClientUpdated'){ echo $data['client_id']; }?>">        
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['name']; }?>">
        <input name="surname" type="text" placeholder="Apellido" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['surname']; }?>">
        <input name="ci" type="text" placeholder="Cedula" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['ci']; }?>">
        <input id="dp1" name="birth" type="text" placeholder="Fecha de Nacimiento" readonly="true" style="cursor:pointer;" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['birth']; }?>">        
        <input name="address" type="text" placeholder="Direccion" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['address']; }?>">
        <input name="phone" type="text" placeholder="Telefono" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['phone']; }?>">
        <input name="mail" type="text" placeholder="Mail" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['mail']; }?>">
        <input name="emergency" type="text" placeholder="Emergencia" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['emergency']; }?>">
        <input name="ocupation" type="text" placeholder="Ocupacion" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['ocupation']; }?>">
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>
        <div class="span6 offset2 right">
        <br><br><br>
        <?php if ($data['status'] != 'ClientUpdated') { ?>
        <a href="<?php echo base_url('subscriptions/create?client_id=').$data['client_id'] ?>" class="btn btn-primary span6">Crear Subscripcion</a>
        <br><br><br>
        <a href="<?php echo base_url('subscriptions/listClientSubscriptions?client_id=').$data['client_id'] ?>" class="btn btn-success span6">Ver Subscripciones</a>
        <br><br><br>
        <a href="<?php echo base_url('routines/create?client_id=').$data['client_id'] ?>" class="btn btn-danger span6">Crear Rutina</a>
        <br><br><br>
        <a href="<?php echo base_url('routines/listClientRoutines?client_id=').$data['client_id'] ?>" class="btn btn-warning span6">Ver Rutinas</a>
        </div>
        <?php } ?>
    </div>
    
</div>
<?php if ($data['status'] == 'ClientUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Cliente editado</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('clients/listClients') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  
<script>
    $(function(){
        $('#dp1').datepicker({
            format: 'yyyy-mm-dd'
        });

    });

</script>