<table id="tabladocentes" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>NRO</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Sexo</th>
        <th>Tipo de Contrato</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tabladocentes-body">
        @foreach ($docentes as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$item->dni}}</td>
          <td>{{$item->nombres}}</td>
          <td>{{$item->apellidos}}</td>
          <td>{{$item->sexo}}</td>
          <td>{{$item->tipocontrato}}</td>
          <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
              <a id="{{$item->id}}" class="btn btn-danger btn_eliminar_docente mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>
              <button type="button" class="btn btn-warning btn_modificar_docente"><i class="fa fa-pencil" aria-hidden="true"></i></button>
              </div>
          </td>
        </tr>                    
        @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>NRO</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Sexo</th>
        <th>Tipo de Contrato</th>
        <th>Acciones</th>
      </tr>
    </tfoot>
  </table>