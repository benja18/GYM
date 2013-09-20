<div class="row-fluid">
    <br><br>
    <div class="span6 offset1">        
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'update', 'action' => '');
        ?>
        <?php echo form_open('users/update', $attributes); ?>
        <legend>Actualizar usuario</legend>
        <input name="user_id" type="hidden" placeholder="User Id" value="<?php if ($data['status'] != 'UserInserted') {echo $_GET['user_id']; }?>">        
        <input name="username" type="text" placeholder="Nombre de usuario" value="<?php if ($data['status'] != 'UserInserted') {echo $data['username']; }?>">
        <input name="password" type="password" placeholder="Contraseña">
        <input name="passwordCheck" type="password" placeholder="Repita contraseña">
        <br><br>
        <button type="submit" class="btn">Actualiar</button>        
        </form>                
    </div>
    <div class="span6"/>
</div>

