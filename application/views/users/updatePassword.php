<div class="row-fluid">    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'WrongPasswords') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Las contraseñas ingresadas no coinciden.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'WrongOldPassword') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>La contraseña antigua no es correcta.</p>
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
        <?php echo form_open('users/updatePassword', $attributes); ?>
        <legend>Cambiar contraseña</legend>
        <input name="user_id" type="hidden" placeholder="User Id" value="<?php if ($data['status'] == '') {echo $_GET['user_id']; } else{ echo $data['user_id']; }?>">        
        <input name="oldPassword" type="password" placeholder="Contraseña anterior">
        <input name="password" type="password" placeholder="Nueva contraseña">
        <input name="passwordCheck" type="password" placeholder="Repita contraseña">
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'UserUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Contraseña actualizada</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('users/listUsers') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  
