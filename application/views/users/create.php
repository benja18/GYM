<h2>Crear usuario</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/create') ?>

	<label for="username">Nombre de usuario</label>
	<input type="input" name="username" /><br />

	<label for="password"></label>
        <input type="password" name="password"/><br />

	<input type="submit" name="submit" value="Crear usuario" />

</form>