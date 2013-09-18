<div class="row-fluid">
    <br><br>
    <div class="span6 offset1">        
        <?php
        echo validation_errors();
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'update');
        ?>
        <?php echo form_open('users/update', $attributes); ?>
        <legend>Actualizar usuario</legend>        
        <input name="username" type="text" placeholder="Nombre de usuario">        
        <input name="password" type="password" placeholder="Contraseña">
        <input name="passwordCheck" type="password" placeholder="Repita contraseña">
        <br><br>
        <button type="submit" class="btn">Actualiar</button>        
        </form>                
    </div>
    <div class="span6"/>
</div>

