<div class="row-fluid">    
    <div class="span6 offset1">
        <?php if ($data['status'] == 'PriceError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes ingresar un precio valido.</p>
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
        <?php echo form_open('expenses/create', $attributes); ?>
        <legend>Crear gasto</legend>
        <input name="name" type="text" placeholder="Nombre">
        <input name="value" type="text" placeholder="Precio">
        <input id="dp1" name="date" type="text" placeholder="Fecha" readonly="true" style="cursor:pointer;">                       
        <br><br>
        <button type="submit" class="btn">Crear</button>        
        </form>
    </div>
    <div class="span6"></div>
</div>
<?php if ($data['status'] == 'ExpenseInserted') { ?>
    <div class="modal hide fade in" style="display: block; ">
        <div class="modal-header">        
            <h3>Mensaje</h3>
        </div>
        <div class="modal-body">
            <h4>Gasto creado</h4>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
        </div>
    </div>
    <div class="modal-backdrop fade in"></div>
<?php } ?>

<script>
    $(function() {
        $('#dp1').datepicker({
            format: 'yyyy-mm-dd'
        });

    });

</script>