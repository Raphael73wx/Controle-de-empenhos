<?php
include('verificar-autenticidade.php');
include('conexao-pdo.php');
$pagina_ativa = "home";


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aquisições</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!-- bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo caminhoURL?>dist/img/logo.jpg" alt="logo" height="160" width="250">
  </div> -->
    <!-- Navbar -->
    <?php
    include('nav.php');
    ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php
    include('aside.php');
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm">
              <h1 class="m-0">Home</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Aquisições</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row" style="justify-content: center ;">
            <div class="col-lg-3 col-6 ">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $tp; ?></h3>
                  <p>Empenhos</p>
                </div>
                <div class="icon">
                  <i class="ion bi  bi-box-seam "></i>
                </div>
                <a href="./ordem-servico" class="small-box-footer">ver todos <i class=" bi bi-plus-circle"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo intval($pr); ?><sup style="font-size: 20px">%</sup></h3>

                  <p>Pedidos concluídos</p>
                </div>
                <div class="icon">
                  <i class="bi bi-dropbox"></i>
                </div>
                <a href="./ordens-servico" class="small-box-footer">ver todas <i class=" bi bi-plus-circle"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">planilha mensal</h3>

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
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer -->
    <?php
    include('footer.php');
    ?>
    <!-- footer -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="dist/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="dist/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- ChartJS -->
  <script src="dist/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    $(function() {

      $("#theme-mode").click(function() {
        //pegar atributo class objeto
        var classMode = $("#theme-mode").attr("class")
        if (classMode == "fas fa-sun") {
          $("body").removeClass("dark-mode");
          $("#theme-mode").attr("class", "fas fa-moon");
          $("#navtopo").attr("class", "main-header navbar navbar-expand navbar-white navbar-light");
          $("#asideMenu").attr("class", "main-sidebar sidebar-light-primary elevation-4");
        } else {
          $("body").addClass("dark-mode");
          $("#theme-mode").attr("class", "fas fa-sun");
          $("#navtopo").attr("class", "main-header navbar navbar-expand nav-black navbar-dark");
          $(" ").attr("class", "main-sidebar sidebar-dark-primary elevation-4")
        }
      });
      //-------------
      //- BAR CHART -
      //-------------
      <?php
      $sql = "
     SELECT COUNT(pk_ordem_servico) total,
     DATE_FORMAT(data_ordem_servico,'%b/%Y')mesAno,
     (
        SELECT COUNT(pk_ordem_servico)
          FROM ordens_servicos
          WHERE DATE_FORMAT(data_ordem_servico, '%m/%y') = DATE_FORMAT(a.data_ordem_servico,'%m/%Y') 
          AND data_fim <> '0000-00-00'
     )total_concluidas
     FROM ordens_servicos a
     WHERE data_ordem_servico >= DATE_SUB(data_ordem_servico, INTERVAL 1 YEAR)
     GROUP BY DATE_FORMAT(data_ordem_servico,'%m/%Y')
     ORDER BY data_ordem_servico
     ";
      try {
        $stmt = $coon->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

        $meses = array();
        $valores = array();
        foreach ($dados as $key => $row) {
          array_push($meses, "'$row->mesAno'");
          array_push($valores, "'$row->total'");
        }
      } catch (PDOException $e) {
        echo "console.log('" . $e->getMessage() . "');";
      }
      ?>


      var areaChartData = {
        labels: [<?php echo implode(",", $meses); ?>],
        datasets: [{
            label: 'Pedidos',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label: 'Pedidos concluidos',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [<?php echo implode(",", $valores); ?>]
          },
        ]
      }

      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })
  </script>
</body>

</html>