<?php
  //if (!isset($_SESSION['id'])) {
    session_start();
    $usuario= [
        'id' => $_SESSION['id'],
        'email' => $_SESSION['name'],
        'name' => $_SESSION['nombre']
    ];
  //

    if(!isset($_SESSION['id'])){
        header('Location: login.html');
        exit();
    }

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
            <link rel="stylesheet" href="../css/custom.css">
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
                                    <h1>Reportes</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                            <a href="#">Home</a>
                                        </li>
                                        
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </section>
    
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                if ($conexion_pg == NULL) {
                                    $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
                                    $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                }
                                    //  users (name, nombre, apellido, password) 
                                $sql = "SELECT 
                                        -- c.id,
                                        c.nombre,
                                        count(1) as test
                                    FROM
                                    productos p
                                    INNER JOIN 
                                    categorias c
                                    ON p.categoria_id = c.id
                                    group by c.nombre
                                    ";
                                    /*
                                        SELECT NAME, SUM(SALARY) FROM COMPANY GROUP BY NAME;
                                    */
                                $stmt = $conexion_pg->prepare($sql);
                                $stmt->execute();
                                $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
                                $count = $stmt->rowCount();
                                $stmt->closeCursor();
                                //print_r($data);
                                $tojson = json_encode($data);
                            ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- DONUT CHART -->
                                    <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Productos por categoría</h3>

                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </section>
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
            <script src="../plugins/chart.js/Chart.min.js"></script>
            <script src="../js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../js/demo.js"></script>
            <!-- <script src="../js/category.js"></script> -->
            <!-- Page specific script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var los2 = <?php echo $tojson; ?> ;
    var etiq = [];
    var datosSet = [];
    
    los2.forEach(element => {
        etiq.push(element.nombre)
        datosSet.push(element.test)
    });
    var donutData        = {
      labels: etiq,
      datasets: [
        {
          data: datosSet,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    console.log(donutData);
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    
    
  })
</script>
        </body>
    </html>
    