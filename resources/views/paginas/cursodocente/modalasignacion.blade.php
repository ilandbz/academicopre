<form name="asignacionform" id="asignacionform" action="asignacion" method="POST">
    <div class="modal fade" id="modalasignacion">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Curso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="">
                  <label for="nombre">Docente</label>
                  <select name="docente_id" id="docente_id" class="form-control">
                    @foreach ($docentes as $item)
                      <option value="{{$item->id}}">{{$item->persona->apellidop.' '.$item->persona->apellidom.', '.$item->persona->nombres}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="credito">Programa</label>
                  <select name="programa_id" id="programa_id" class="form-control">
                    @foreach ($programas as $item)
                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="estado">Curso</label>
                  <select name="curso_id" id="curso_id" class="form-control">
                    @foreach ($cursos as $item)
                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                  </select>
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