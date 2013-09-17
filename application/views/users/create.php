<div class="row-fluid">
    <br><br>    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'WrongPasswords') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Las contraseñas ingresadas no coinciden.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'UsernameDuplicated') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El nombre de usuario ya existe.</p>
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
        <?php echo form_open('users/create', $attributes); ?>
        <legend>Crear usuario</legend>        
        <input name="username" type="text" placeholder="Nombre de usuario">        
        <input name="password" type="password" placeholder="Contraseña">
        <input name="passwordCheck" type="password" placeholder="Repita contraseña">
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span6"/>    
</div>
<?php //if ($data['status'] == 'UserInserted') { ?>
    <div id="modalSuccess" class="modal hide fade in" aria-hidden="false" style="display: block;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Usuario creado</h3>
        </div>
        <div class="modal-body">    
        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>
    <?php //} ?>  