<?php
if (!$this->session->userdata('logged_in')) {
//Not logged in, redirect to a public page
    redirect('home', 'refresh');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Habana GYM</title>

        <!-- Bootstrap core CSS -->     
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/datatable.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/datepicker.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/datatable.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/ajax_functions.js') ?>"></script>
    </head>
    <body class="bs-docs-home">        
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <a class="brand" href="<?php echo base_url('home') ?>">Habana Gym</a>
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-exclamation-sign"></i> Vencimientos<b class="caret"></b> <span class="badge badge-warning"><?php echo $data['nextExpirationsCounter']; ?></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('subscriptions/listNextExpirations') ?>"><span class="badge badge-warning"><?php echo $data['nextExpirationsCounter']; ?></span> Proximos vencimientos</a></li>
                            <li><a href="<?php echo base_url('subscriptions/listExpired') ?>"><span class="badge badge-important"><?php echo $data['expiredClientsCount']; ?></span> Socios a renovar</a></li>
                            <li><a href="<?php echo base_url('subscriptions/listSubscriptionsUnpaid') ?>"><span class="badge badge-inverse"><?php echo $data['unpaidSubscriptionsCounter']; ?></span> Subscripciones sin pagar</a></li>
                            <li><a href="<?php echo base_url('debts/listDebts') ?>"><span class="badge badge-info"><?php echo $data['debtsCount']; ?></span> Deudas</a></li>
                            <li><a href="<?php echo base_url('clients/listBirths') ?>"><span class="badge badge-success"><?php echo $data['clientsBirths']; ?></span> Cumpleaños</a></li>
                            <li><a href="<?php echo base_url('subscriptions/findSubscriptions') ?>"><i class="icon-search"></i> Buscar subscripciones</a></li>                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Socios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('clients/create') ?>"><i class="icon-plus"></i> Agregar socio</a></li>                            
                            <li><a href="<?php echo base_url('clients/listClients') ?>"><i class="icon-list"></i> Ver todos los socios</a></li>
                            <li><a href="<?php echo base_url('clients/listActiveClients') ?>"><i class="icon-list"></i> Ver socios activos</a></li>
                            <li><a href="<?php echo base_url('clients/listInactiveClients') ?>"><i class="icon-list"></i> Ver socios inactivos</a></li>
                            <li><a href="<?php echo base_url('subscriptionTypes/create') ?>"><i class="icon-plus"></i> Agregar tipo de subscripcion</a></li>
                            <li><a href="<?php echo base_url('subscriptionTypes/listSubscriptionTypes') ?>"><i class="icon-list"></i> Ver tipos de subscripciones</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i> Ejercicios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('muscles/create') ?>"><i class="icon-plus"></i> Agregar musculo</a></li>
                            <li><a href="<?php echo base_url('muscles/listMuscles') ?>"><i class="icon-list"></i> Ver musculos</a></li>                            
                            <li><a href="<?php echo base_url('exercises/create') ?>"><i class="icon-plus"></i> Agregar ejercicio</a></li>
                            <li><a href="<?php echo base_url('exercises/listExercises') ?>"><i class="icon-list"></i> Ver ejercicios</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i> Cuentas <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('expenses/create') ?>"><i class="icon-plus"></i> Agregar gasto</a></li>                            
                            <li><a href="<?php echo base_url('expenses/listExpenses') ?>"><i class="icon-list"></i> Ver gastos</a></li>                            
                            <li><a href="<?php echo base_url('expenses/earnings') ?>"><i class="icon-book"></i> Calcular cuentas</a></li>
                            <li><a href="<?php echo base_url('debts/listDebts') ?>"><i class="icon-warning-sign"></i> Ver deudas</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><b class="caret"></b></a>                                
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('users/create') ?>"><i class="icon-plus"></i> Agregar usuario</a></li>
                            <li><a href="<?php echo base_url('users/listUsers') ?>"><i class="icon-list"></i> Ver usuarios</a></li>
                            <li><a href="<?php echo base_url('configurations/updateExpirationInterval') ?>"><i class="icon-calendar"></i> Alerta de expiracion</a></li>
                            <li><a href="<?php echo base_url('configurations/backup') ?>"><i class="icon-hdd"></i> Backup</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-off"></i><b class="caret"></b></a>                                
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('home/logout') ?>"><i class="icon-share-alt"></i> Cerrar sesion</a></li>                            
                        </ul>
                    </li>                   
                </ul>
            </div>            
        </div>
        <br><br><br><br>