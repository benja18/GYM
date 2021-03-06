<div class="row-fluid">    
    <div class="span10 offset1">
        <?php if ($data['status'] == 'CiDuplicated') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Ya existe un cliente con esta cedula.</p>
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
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar todos los campos.</p>
            </div>
        <?php } ?>
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create', 'enctype' => 'multipart/form-data');
        ?>
        <?php echo form_open('clients/create', $attributes); ?>
        <legend>Crear Socio</legend>        
        <input name="name" type="text" placeholder="Nombre">
        <input name="surname" type="text" placeholder="Apellido">
        <input name="ci" type="text" placeholder="Cedula">
        <input id="dp1" name="birth" type="text" placeholder="Fecha de Nacimiento" style="cursor:pointer;">        
        <input name="address" type="text" placeholder="Direccion">
        <input name="phone" type="text" placeholder="Telefono">
        <input name="mail" type="text" placeholder="Mail">
        <input name="emergency" type="text" placeholder="Emergencia">
        <input name="disease" type="text" placeholder="Enfermedad">
        <input name="ocupation" type="text" placeholder="Ocupacion">
        <label>Adjuntar foto</label>
        <input name="photo" type="file">
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span2"></div>
</div>
<?php if ($data['status'] == 'ClientInserted') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Socio creado. Desea crearle una subscripcion?</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('subscriptions/create?client_id=').$data['client_id'] ?>" class="btn btn-primary">Si</a>
        <a href="<?php echo base_url('clients/listClients')?>" class="btn btn-primary">No</a>
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