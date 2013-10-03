<script type="text/javascript">// <![CDATA[
    $(document).ready(function(){       
        $('#muscles').click(function(){ //any select change on the dropdown with id muscle trigger this code         
            $("#exercises > option").remove(); //first of all clear select items
            var muscle_id = $('#muscles').val();  // here we are taking muscle id of the selected one.
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('routines/getExercises') ?>/"+muscle_id, //here we are calling our user controller and get_exercises method with the muscle_id
                 
                success: function(exercises) //we're calling the response json array 'exercises'
                {
                    $.each(exercises,function(exercise_id,name) //here we're doing a foeach loop round each exercise with id as the key and exercise as the value
                    {
                        var opt = $('<option />'); // here we're creating a new select option with for each exercise
                        opt.val(exercise_id);
                        opt.text(name);
                        $('#exercises').append(opt); //here we will append these new select options to a dropdown with the id 'exercises'
                    });
                }
                 
            });
             
        });
    });
    // ]]>
</script>
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
        $attributes = array('role' => 'form', 'class' => 'span4', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('routines/addExercise', $attributes); ?>
        <legend>Agregar ejercicio</legend>
        <input name="client_id" type="hidden" value="<?php if ($data['status'] == '') {echo $_GET['client_id']; } elseif($data['status'] != 'ExerciseInserted'){ echo $data['client_id']; }?>">
        <input name="routine_id" type="hidden" value="<?php if ($data['status'] == '') {echo $_GET['routine_id']; } elseif($data['status'] != 'ExerciseInserted'){ echo $data['routine_id']; }?>">
        <label>Musculo</label>
        <select id="muscles" name="muscle_id">
            <?php foreach ($data['muscles'] as $muscle) { ?>
                <option value="<?php echo $muscle->muscle_id ?>"><?php echo $muscle->name ?></option>
            <?php } ?>
        </select>
        <label>Ejercicio</label>
        <select id="exercises" name="exercises_exercise_id">  
        </select>
        <label>Dia</label>
        <select name="day">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option>
            <option value="Domingo">Domingo</option>
        </select>        
        <br><br>
        <button type="submit" class="btn">Agregar</button>        
        </form>
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'ExerciseInserted') { ?>
    <div class="modal hide fade in" style="display: block; ">
        <div class="modal-header">        
            <h3>Mensaje</h3>
        </div>
        <div class="modal-body">
            <h4>Ejercicio agregado</h4>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('routines/listClientRoutines?client_id=').$data['client_id'] ?>" class="btn btn-primary">Aceptar</a>        
        </div>
    </div>
    <div class="modal-backdrop fade in"></div>
<?php } ?>