<form name="programaform" id="programaform" action="programas" method="POST">
    <div class="modal fade" id="modalprograma">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Programa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="">
                  <label for="nombre">NOMBRE</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="aula_id">Aula</label>
                  <select name="aula_id" id="aula_id" class="form-control" required>
                    <option value="">Seleccione</option>
                    @foreach ($aulas as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="vacantes">Vacantes</label>
                  <input type="text" class="form-control" id="vacantes" name="vacantes" placeholder="">
                </div>
                <div class="form-group">
                  <label for="semestre_id">Semestre</label>
                  <select name="semestre_id" id="semestre_id" class="form-control">
                  @foreach ($semestres as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
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