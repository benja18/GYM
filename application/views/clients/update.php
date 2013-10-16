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
        <?php if ($data['status'] == 'InvalidSize') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El tamaño de la foto debe ser menor a 9MB.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'InvalidFormat') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El foramto de la foto debe ser jpeg, jpg o png.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'FileError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>La foto seleccionada no es valida.</p>
            </div>
        <?php } ?>
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create', 'enctype' => 'multipart/form-data');
        ?>
        <?php echo form_open('clients/update', $attributes); ?>
        <legend>Editar Socio</legend>
        <center ><img style="width: 150px;height: 192px;"src="<?php if ($data['status'] != 'ClientUpdated') {echo base_url('assets/photos').'/'.$data['photo']; }?>"></center>
        <br><br>
        <input name="client_id" type="text" readonly="true" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } elseif($data['status'] != 'ClientUpdated'){ echo $data['client_id']; }?>">        
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['name']; }?>">
        <input name="surname" type="text" placeholder="Apellido" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['surname']; }?>">
        <input name="ci" type="text" placeholder="Cedula" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['ci']; }?>">
        <input id="dp1" name="birth" type="text" placeholder="Fecha de Nacimiento" style="cursor:pointer;" value="<?php if ($data['status'] != 'ClientUpdated' && !empty($data['birth'])) {echo date('d-m-Y',  strtotime($data['birth'])); }?>">        
        <input name="address" type="text" placeholder="Direccion" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['address']; }?>">
        <input name="phone" type="text" placeholder="Telefono" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['phone']; }?>">
        <input name="mail" type="text" placeholder="Mail" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['mail']; }?>">
        <input name="emergency" type="text" placeholder="Emergencia" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['emergency']; }?>">
        <input name="disease" type="text" placeholder="Enfermedad" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['disease']; }?>">
        <input name="ocupation" type="text" placeholder="Ocupacion" value="<?php if ($data['status'] != 'ClientUpdated') {echo $data['ocupation']; }?>">
        <select name="active">
            <?php if($data['status'] != 'ClientUpdated'){?> 
            <option value="1" <?php if ($data['active'] == 1){echo 'selected';}?>>Si</option>
            <option value="0" <?php if ($data['active'] == 0){echo 'selected';}?>>No</option>
           <?php } ?>
        </select>
        <label>Adjuntar foto</label>
        <input name="photo" type="file">
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>
        <?php if ($data['status'] != 'ClientUpdated') { ?>
        <div class="span6 offset2 right">
        <br><br><br>        
        <a href="<?php echo base_url('subscriptions/create?client_id=').$data['client_id'] ?>" class="btn btn-primary span6">Crear Subscripcion</a>
        <br><br><br>
        <a href="<?php echo base_url('subscriptions/listClientSubscriptions?client_id=').$data['client_id'] ?>" class="btn btn-success span6">Ver Subscripciones</a>
        <br><br><br>
        <a href="<?php echo base_url('routines/create?client_id=').$data['client_id'] ?>" class="btn btn-danger span6">Crear Rutina</a>
        <br><br><br>
        <a href="<?php echo base_url('routines/listClientRoutines?client_id=').$data['client_id'] ?>" class="btn btn-warning span6">Ver Rutinas</a>
        <br><br><br>
        <a href="<?php echo base_url('debts/create?client_id=').$data['client_id'] ?>" class="btn btn-inverse span6">Crear Deuda</a>
        <br><br><br>
        <a href="<?php echo base_url('debts/listClientDebts?client_id=').$data['client_id'] ?>" class="btn btn-inverse span6">Ver Deudas</a>
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
        checkin = $('#dp1').datepicker({
            format: 'dd-mm-yyyy'            
        }).on('changeDate', function(ev) {         
          checkin.datepicker('hide');
        });
    });
</script>