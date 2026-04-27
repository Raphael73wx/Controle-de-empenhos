<aside id="asideMenu" class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo caminhoURL ?>" class="brand-link">
    <img src="<?php echo caminhoURL?>assets/imagens/assetsall/logonav1.png" alt="Logo" class="brand-image rounded-circle" style="opacity: .8">
    <span class="brand-text font-weight-light">adm</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo caminhoURL . 'assets/imagens/usuarios/' . $_SESSION["foto_usuario"]; ?>" class="img-circle elevation-2" alt="<?php echo $_SESSION["nome_usuario"] ?>">
      </div>
      <div class="info">
        <a href="<?php echo caminhoURL; ?>perfil.php" class="d-block"><?php echo $_SESSION["nome_usuario"] ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo caminhoURL; ?>index.php" class="nav-link <?php echo $pagina_ativa == 'home' ? 'active' : ''; ?>">
            <i class="nav-icon bi bi-house"></i>
            <p>
              Pagina inicial
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo caminhoURL ?>empenhos/" class="nav-link <?php echo $pagina_ativa == 'empenhos' ? 'active' : ''; ?>">
            <i class="nav-icon bi bi-box-seam text-success  mr-1 "></i>
            <p>
              empenhos
              <span class="right badge badge-danger"></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo caminhoURL ?>fornecedores/" class="nav-link <?php echo $pagina_ativa == 'fornecedores' ? 'active' : ''; ?>">
            <i class="nav-icon bi bi-box-seam text-success  mr-1 "></i>
            <p>
               fornecedores
              <!-- <span class="right badge badge-danger"></span> -->
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>