<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>NRO</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>DNI</th>
        <th>Sexo</th>
        <th>Tipo de Contrato</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($docentes as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{$item->nombres}}</td>
        <td>{{$item->apellidos}}</td>
        <td>{{$item->dni}}</td>
        <td>{{$item->sexo}}</td>
        <td>{{$item->tipocontrato}}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>NRO</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>DNI</th>
        <th>Sexo</th>
        <th>Tipo de Contrato</th>
        <th>Acciones</th>
      </tr>
    </tfoot>
  </table>