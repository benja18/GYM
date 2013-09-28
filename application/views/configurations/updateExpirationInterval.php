<div class="row-fluid">    
    <div class="span8 offset1">
        <?php if ($data['status'] == 'ValidationError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes completar el campo.</p>
            </div>
        <?php } ?>
        <?php if ($data['status'] == 'IntervalNumericError') { ?>
            <div class="alert alert-block alert-error fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Error!</h4>
                <p>Debes ingresar un numero valido.</p>
            </div>
        <?php } ?>
        <?php        
        $attributes = array('role' => 'form', 'class' => 'span3', 'id' => 'myform', 'name' => 'create');
        ?>
        <?php echo form_open('configurations/updateExpirationInterval', $attributes); ?>
        <legend>Actualizar intervalo de dias de vencimientos</legend>        
        <input name="configuration_value" type="text" placeholder="Cantidad de dias" value="<?php echo $data['expirationInterval'] ?>">                
        <br><br>
        <button type="submit" class="btn">Actualizar</button>        
        </form>
    </div>
    <div class="span4"></div>
</div>
<?php if ($data['status'] == 'IntervalUpdated') { ?>
<div class="modal hide fade in" style="display: block; ">
    <div class="modal-header">        
        <h3>Mensaje</h3>
    </div>
    <div class="modal-body">
        <h4>Intervalo actualizado</h4>
    </div>
    <div class="modal-footer">
        <a href="<?php echo base_url('') ?>" class="btn btn-primary">Aceptar</a>        
    </div>
</div>
<div class="modal-backdrop fade in"></div>
<?php } ?>  