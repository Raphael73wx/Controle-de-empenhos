<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');
$pagina_ativa = "empenhos";
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
                                    <h3 class="card-title">Empenhos</h3>
                                    <form method="GET" action="" class="mb-0 ml-auto">
                                        <div class="input-group">
                                          <input type="text" name="busca" class="form-control" placeholder="Digitar nome do empenho..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
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
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover text-nowrap m-0">
                                            <thead>
                                                <tr>
                                                    <th>cod</th>
                                                    <th>nome</th>
                                                    <th>setor</th>
                                                    <th>preco</th>
                                                    <th>cnpj</th>
                                                    <th>quantidade</th>
                                                    <th>financeiro num</th>
                                                    <th>financeiro</th>
                                                    <th>ordem bancaria</th>
                                                    <th>num ordem bancaria</th>
                                                    <th>valor de entrega</th>
                                                    <th>nota fiscal num</th>
                                                    <th>nota fiscal</th>
                                                    <th>num requisicao</th>
                                                    <th>data de envio</th>
                                                    <th>envio do empenho</th>
                                                    <th>codigo do empenho</th>
                                                    <th>conclusao do empenho</th>
                                                    <th>not atraso</th>
                                                    <th class="text-center">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
                                                if ($busca !== '') {
                                                // SQL com filtro de busca por nome
                                                $sql = "
                                                SELECT *
                                                FROM empenhos
                                                WHERE nome LIKE :busca
                                                ORDER BY pk_empenhos
                                                ";
                                                } else {
                                                // SQL padrão sem filtro
                                                $sql = "
                                                SELECT *
                                                FROM empenhos
                                                ORDER BY pk_empenhos
                                                ";    
                                                }
                                                // Prepara a sintaxe na conexão utilizando a sua variável \$coon
                                                $stmt = $coon->prepare($sql);
                                                if ($busca !== '') {
                                                $termo = "%" . $busca . "%";
                                                $stmt->bindParam(':busca', $termo);
                                                }

                                                $stmt->execute();
                                                $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

                                                foreach ($dados as $row) {
                                                    echo '
                                                    <tr>
                                                        <td>' . htmlspecialchars($row->pk_empenhos ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->nome ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->setor ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->preco ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->cnpj ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->quantidade ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->financeiro_num ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->financeiro ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->ordem_bancaria ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->num_ordem_bancaria ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->valor_de_entrega ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->nota_fiscal_num ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->nota_fiscal ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->num_requisicao ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->data_de_envio ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->envio_do_empenho ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->codigo_do_empenho ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->conclusao_do_empenho ?? '') . '</td>
                                                        <td>' . htmlspecialchars($row->not_atraso ?? '') . '</td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bi bi-tools"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                                    <a class="dropdown-item" href="form.php?ref=' . base64_encode($row->pk_empenhos) . '">
                                                                        <i class="bi bi-pencil text-primary mr-2"></i> Editar
                                                                    </a>
                                                                    <a class="dropdown-item" href="remover.php?ref=' . base64_encode($row->pk_empenhos) . '">
                                                                        <i class="bi bi-trash text-danger mr-2"></i> Remover
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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