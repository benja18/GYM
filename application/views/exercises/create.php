<div class="row-fluid">
    <br><br>    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'NameDuplicated') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>El nombre del ejercicio ya existe.</p>
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
        <?php echo form_open('exercises/create', $attributes); ?>
        <legend>Crear ejercicio</legend>        
        <input name="name" type="text" placeholder="Nombre">        
        <?php foreach ($data['muscles'] as $muscle) { ?>
            <select name="muscle_id">
                <option value="<?php echo $muscle->muscle_id ?>"><?php echo $muscle->name ?></option>
            </select>
        <?php } ?>
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span6"/>    
</div>
<?php if ($data['status'] == 'ExerciseInserted') { ?>
    <div class="modal hide fade in" style="display: block; ">
        <div class="modal-header">        
            <h3>Mensaje</h3>
        </div>
        <div class="modal-body">
            <h4>Ejercicio creado</h4>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
        </div>
    </div>
    <div class="modal-backdrop fade in"></div>
<?php } ?>  