<div class="row-fluid">
    <br><br>
    <div class="span6 offset1">
        <?php if ($data['status'] == 'NameDuplicated') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El nombre del musculo ya existe.</p>
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
        <?php echo form_open('muscles/update', $attributes); ?>
        <legend>Editar musculo</legend>
        <input name="muscle_id" type="hidden" placeholder="Muscle Id" value="<?php if ($data['status'] == '') {echo $_GET['muscle_id']; } else{ echo $data['muscle_id']; }?>">        
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'MuscleUpdated') {echo $data['name']; }?>">
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'MuscleUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Musculo editado</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  
