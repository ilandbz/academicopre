<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DOCENTES</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista General de Usuarios</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <div class="input-group">
                  <div class="input-group-append pull-right">
                      <button type="submit" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#modalnuevodocente">
                          Nuevo Registro <i class="fas fa-user-plus"></i>
                      </button>
                  </div>
              </div>
            <br>
            <div id="vtabladocentes">
              @include('paginas.docentes.vistatabla')
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<form name="nuevodocente" id="nuevodocente" action="docentes" method="POST">
  <div class="modal fade" id="modalnuevodocente">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title tex-dark">Nuevo Docente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres">
              </div>
              <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
              </div>
              <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI">
              </div>
              <div class="form-group">
                <label for="dni">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="dni">Contraseña Confirmar</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
              </div>
              <div class="form-group">
                <label>Sexo</label>
                <select class="form-control" name="sexo">
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tipo de Contrato</label>
                <select class="form-control" name="tipocontrato">
                  <option value="Contratado">Contratado</option>
                  <option value="Nombrado">Nombrado</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->    
</form>  

