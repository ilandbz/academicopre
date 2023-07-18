<div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="usuarios" class="nav-link {{ request()->is('usuarios') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Usuarios
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="personas" class="nav-link {{ request()->is('personas') ? 'active' : '' }}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              Personas
            </p>
          </a>
        </li>        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
              Academico
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="programas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Programas de Estudio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="aulas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Aulas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="cursos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cursos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="matricula" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Matricula</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clock"></i>
            <p>
              Horarios
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="horario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Administrar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
              Pagos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/UI/general.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>General</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="docentes" class="nav-link {{ request()->is('docentes') ? 'active' : '' }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>
              Docente
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Cursos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="cursos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Administracion</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="asignacion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Asignacion</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="horario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Horarios</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>
              Programas Educativos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/tables/simple.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Programas Educ.</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/tables/data.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>DataTables</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>