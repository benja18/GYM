<h2>Crear usuario</h2>

<?php //echo validation_errors(); ?>

<?php //echo form_open('users/create') ?>
<!--
	<label for="username">Nombre de usuario</label>
	<input type="input" name="username" /><br />

	<label for="password"></label>
        <input type="password" name="password"/><br />

	<input type="submit" name="submit" value="Crear usuario" />

</form>
-->
<p></p>
<br><br>
<?php 
    echo validation_errors(); 
    $attributes = array('role' => 'form', 'class' => 'col-sm-3', 'id' => 'myform', 'name' => 'create');
?>
<?php echo form_open('users/create', $attributes); ?>
<!--<form role="form" name="create" action="<?php //echo base_url('application/controllers/users/create') ?>" method="POST" class="col-sm-3">-->
  <div class="form-group">
    <label for="username">Nombre de usuario</label>
    <input type="username" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default">Crear</button>
</form>