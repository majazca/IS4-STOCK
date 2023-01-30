<?php
session_start();
    $usuario= [
      'id' => $_SESSION['id'],
      'email' => $_SESSION['name'],
      'name' => $_SESSION['nombre']
    ];
    include __DIR__."/../config.php";
    include RUTA."/php/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AdminLTE 3 | Projects</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="../plugins/fontawesome-free/css/all.min.css"
        />
        <!-- Theme style -->
        <link rel="stylesheet" href="../css/adminlte.min.css" />
    </head>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <!-- Main Sidebar Container -->
            <?php include DIR."/php/incluir/sidebar.php"; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Productos</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Projects
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <?php 
                    if (
                        isset($_GET["action"]) && 
                        in_array($_GET["action"], ['listar', 'lista']) 
                        || !isset($_GET["action"])
                    ) {
                        include "productos-lista.php"; 
                    }

                    if (isset($_GET["action"]) && $_GET["action"] == 'agregar') {
                        include "productos-agregar.php"; 
                    }
                    
                    if (isset($_GET["action"]) && $_GET["action"] == 'editar') {
                        if (isset($_GET["sku"]) && is_numeric($_GET["sku"])) {
                            include "productos-editar.php";
                        }else{
                            include "productos-lista.php"; 
                        }
                    }
                    
                ?>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include DIR."/php/incluir/footer.php"; ?>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../js/demo.js"></script>
        <script src="../js/category.js"></script>
    </body>
</html>
