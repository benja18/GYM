<div class="row-fluid">
    <br><br>
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
        <?php echo form_open('exercises/update', $attributes); ?>
        <legend>Editar ejercicio</legend>
        <input name="exercise_id" type="hidden" placeholder="Exercise Id" value="<?php if ($data['status'] == '') {echo $_GET['exercise_id']; } else{ echo $data['exercise_id']; }?>">        
        <input name="name" type="text" placeholder="Nombre" value="<?php if ($data['status'] != 'ExerciseUpdated') {echo $data['exercise']['name']; }?>">
        <select name="muscle_id">
            <?php foreach ($data['muscles'] as $muscle) { ?>
            <option value="<?php echo $muscle->muscle_id ?>" <?php if ($data['exercise']['muscles_muscle_id'] == $muscle->muscle_id){echo 'selected';}?>><?php echo $muscle->name ?></option>            
            <?php } ?>
        </select>
        <br><br>        
        <button type="submit" class="btn">Actualizar</button>        
        </form>                
    </div>
    <div class="span6"/>
</div>
<?php if ($data['status'] == 'ExerciseUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Ejercicio editado</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  
