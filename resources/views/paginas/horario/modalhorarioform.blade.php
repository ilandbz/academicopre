<form name="horarioform" id="horarioform" action="horario" method="POST">
    <div class="modal fade" id="modalhorarioform">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Horario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="form-group">
                <label for="dia">Día:</label>
                <input type="hidden" value="" name="curso_id">
                <select name="dia" id="dia" class="form-control" required>
                  <option value="">Seleccione un día</option>
                  <option value="lunes">Lunes</option>
                  <option value="martes">Martes</option>
                  <option value="miércoles">Miércoles</option>
                  <option value="jueves">Jueves</option>
                  <option value="viernes">Viernes</option>
                </select>
              </div>
              <div class="form-group">
                <label for="horaingreso">Hora de Ingreso:</label>
                <input type="time" name="horaingreso" id="horaingreso" class="form-control" required>
              </div>
            
              <div class="form-group">
                <label for="horasalida">Hora de Salida:</label>
                <input type="time" name="horasalida" id="horasalida" class="form-control" required>
              </div>
            
              <div class="form-group">
                <label for="observacion">Observación:</label>
                <textarea name="observacion" id="observacion" class="form-control"></textarea>
              </div>
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