<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');
$pagina_ativa = "fornecedores";
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empenhos Cmavex</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/plugins/fontawesome-free/css/all.min.css">
    <!-- bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- sweet Alert 2  -->
    <link rel="stylesheet" href="../dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloade-->
        <?php
        include('../nav.php');
        ?>
        <!-- Main Sidebar Container -->
        <?php
        include('../aside.php');
        ?>

        <!-- Navbar -->
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card card-olive card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Fornecedores</h3>
                                    <!-- Formulário de Busca -->
                                    <form method="GET" action="" class="mb-0 ml-auto">
                                        <div class="input-group">
                                          <input type="text" name="busca" class="form-control" placeholder="Digitar nome do fornecedor..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="submit">
                                                    <i class="fas fa-search"></i> Buscar
                                                </button>
                                                <?php if (isset($_GET['busca']) && $_GET['busca'] !== ''): ?>
                                                <a href="./" class="btn btn-outline-secondary">Limpar</a>
                                                <?php endif; ?>
                                            </div>
                                            <a  href="./form.php" class="btn bt-sm btn-info float-right rounded-circle ml-2 d-flex align-items-center justify-content-center">
                                                 <i class="bi bi-plus"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>cod</td>
                                                <td>Pedido</td>
                                                <td>telefone</td>
                                                <td>Email</td>
                                                <td>cnpj</td>
                                                <td>tipo de fornecimento </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Captura o termo de busca se ele existir
                                            $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

                                            if ($busca !== '') {
                                            // SQL com filtro de busca por nome
                                            $sql = "
                                            SELECT *
                                            FROM fornecedores
                                            WHERE nome LIKE :busca
                                            ORDER BY pk_fornecedores
                                            ";
                                            } else {
                                            // SQL padrão sem filtro
                                            $sql = "
                                            SELECT *
                                            FROM fornecedores
                                            ORDER BY pk_fornecedores
                                            ";
                                            }

                                            // Prepara a sintaxe na conexão (corrigido para $conn)
                                            $stmt = $coon->prepare($sql);

                                            // Se houver busca, vincula o parâmetro com os coringas % do SQL
                                            if ($busca !== '') {
                                            $termo = "%" . $busca . "%";
                                            $stmt->bindParam(':busca', $termo);
                                            }

                                            // Executa o comando MYSQL
                                            $stmt->execute();

                                            // Recebe as informações vindas do MYSQL
                                            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

                                            // Laço de repetição para printar informações

                                            foreach ($dados as $row) {
                                                echo '
                                            <tr>
                                            <td>' . $row->pk_fornecedores . '</td>
                                            <td>' . $row->nome . '</td>
                                            <td>' . $row->telefone . '</td>
                                            <td>' . $row->email . '</td>
                                            <td>' . $row->cnpj . '</td>
                                            <td>' . $row->tipo_de_fornecimento . '</td>
                                            
                                            <td>
                                            <div class="btn-group">
                                            <button class="btn btn-default dropdown-toggle dropdown-toggle" type="button" data-toggle="dropdown">
                                              <i class="bi bi-tools"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <a class="dropdown-item" href="form.php?ref=' . base64_encode($row->pk_fornecedores) . '">
                                                <i class="bi bi-pencil"></i>Editar
                                              </a>
                                              <a class="dropdown-item" href="remover.php?ref=' . base64_encode($row->pk_fornecedores) . '">
                                                <i class="bi bi-trash"></i>Remover
                                              </a>
                                              </div>
                                            </div>
                                            </td>
                                        
                                            </tr>
                                            ';
                                            }

                                            ?>

                                        </tbody>
                                    </table>
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
        include('../footer.php');
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
    <script src="../dist/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../dist/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- SweetAlert2-->
    <script src="../dist/plugins/sweetalert2/sweetalert2.min.js"></script>

    <?php
    include("../sweet-alert-2.php");
    ?>



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

        })
    </script>

</body>

</html>