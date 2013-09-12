<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GYM</title>

        <!-- Bootstrap core CSS -->     
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    </head>
    <body class="bs-docs-home">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">          
                <a class="navbar-brand" href="<?php echo base_url() ?>">Habana Gym</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Vencimientos <span class="badge">3</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>  Socios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Agregar socio</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar socio</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-book"></span> Ver socios</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-list"></span> Subscripciones y rutinas</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Tipos de subscripciones</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Ejercicios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Agregar musculo</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar musculo</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Eliminar musculo</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Agregar ejercicio</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar ejercicio</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Eliminar ejercicio</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-eye-open"></span>  Usuarios <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Agregar usuario</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar usuario</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Eliminar usuario</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-exclamation-sign"></span> Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </div>
                    <button type="submit" class="btn btn-default">Buscar</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </nav>
        <br><br>