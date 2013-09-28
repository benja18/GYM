<div class="row-fluid">    
    <div class="span6 offset1">
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
        <?php echo form_open('routines/update', $attributes); ?>
        <legend>Editar rutina</legend>      
        <input name="routine_id" type="hidden" value="<?php if ($data['status'] == '') {echo $_GET['routine_id']; } elseif($data['status'] != 'RoutineUpdated'){ echo $data['routine_id']; }?>">
        <input name="clients_client_id" type="hidden" value="<?php if ($data['status'] != 'RoutineUpdated') {echo $data['clients_client_id']; }?>">        
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'RoutineUpdated') {echo $data['name']; }?>"><br><br>        
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'RoutineUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Rutina editada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>