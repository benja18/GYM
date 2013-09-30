<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Habana GYM</title>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/datatable.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/datepicker.css') ?>" rel="stylesheet"/>
        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/datatable.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/ajax_functions.js') ?>"></script>
    </head>
    <body>       
        <div class="row span12">
            <br><br><br><br><br><br><br><br><br>
            <center>
                <h1 class="span12 offset2">Iniciar sesion</h1>
                <?php if ($data['status'] == 'ValidationError') { ?>
                    <div class="span4 offset6">
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4 class="alert-heading">Error!</h4>
                            <p>Debes completar el campo.</p>
                        </div>
                    </div>
                <?php } ?>
                <?php
                $attributes = array('role' => 'form', 'class' => 'form-horizontal span12 offset1', 'id' => 'myform', 'name' => 'create');
                ?>   
                <?php echo form_open('verifylogin', $attributes); ?>   
                <div class="control-group">    
                    <div class="controls">
                        <input type="text" id="username" name="username" placeholder="Nombre de usuario"/>
                    </div>
                </div>
                <div class="control-group">    
                    <div class="controls">
                        <input type="password" id="password" name="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                    </div>
                </div>
            </form>
            </center>
        </div>
    </body>
</html>

