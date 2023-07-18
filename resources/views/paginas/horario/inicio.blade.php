@extends('layout')
@section('estilos')
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
@endsection
@section('preloader')
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="imagenes/logo.png" alt="IESTP Alto Huallaga" height="200" width="200">
  </div>    
@endsection
@section('maincontent')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Cursos</h3>
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
          <div class="form-group col-md-2">
            <label for="dni">SEMESTRE</label>
            <select name="semestre_id" id="semestre_id" class="form-control">
              @foreach ($semestres as $item)
                  <option value="{{$item->id}}">{{$item->nombre}}</option>
              @endforeach
            </select>
          </div>
        <br>
        @include('paginas.horario.tabla')
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@include('paginas.horario.modalhorarioform')
@include('paginas.horario.modalhorarios')
@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
@endsection

@section('script')
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script>
  let csrf_token = $('meta[name="csrf-token"]').attr('content');


    document.getElementById('horarioform').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        var form = document.getElementById('horarioform');
        $('.alert-danger').remove();
        $.ajax({
            type:'POST',
            // datatype: 'json',
            url: this.action,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
              form.reset();
              $("#modalhorarioform").modal('hide');
              toastr.success(data.mensaje)
            },
            error: function(xhr) {
              let res = xhr.responseJSON
              if($.isEmptyObject(res) === false) {
                  $.each(res.errors,function (key, value){
                      $("input[name='"+key+"']").closest('.form-group')
                      .append('<div class="alert alert-danger" role="alert">'+ value+ '</div>')
                  });
              }

          }
        });
    });

    carga_inicial();
    function carga_inicial(){ 
      $("#tablamatriculas").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tablamatriculas_wrapper .col-md-6:eq(0)');
      cargar_datatable();
    }
    function cargar_datatable(){
      var table = $('#tablamatriculas').DataTable();
      table.clear();
      $.ajax({
          dataType:'json',
          url: 'matricula-lista',
          success: function(data) {
            let numero_orden = 1;
              (data.registros).forEach(function(repo) {
                  table.row.add([
                  numero_orden,
                  repo.Fecha Hora,
                  repo.usuario.email,
                  repo.programa.nombre,
                  repo.alumno.nombres+' '+repo.alumno.apellidop+' '+repo.alumno.apellidom,
                  repo.semestre.nombre,
                  '<div class="btn-group" role="group" aria-label="Basic mixed styles example">'+
                    '<a id="'+repo.id+'" class="btn btn-info btn_mostrar_horario mr-1"><i class="fa fa-eye" aria-hidden="true"></i></a>'+
                    '<a id="'+repo.id+'" class="btn btn-warning btn_agregar_horario mr-1"><i class="fas fa-clock"></i></a>' +
                  '</div>'
                ]).draw();
                  numero_orden++;
              });
          }
      })
    }
    function cargartablahorarios(data){
      let tableBody = $('#horariostabla').find('tbody');
      tableBody.empty();
      let numero_orden = 1;
      data.horarios.forEach(function(registro) {
        let newRow = $('<tr>');
        newRow.append($('<td>').text(numero_orden));
        newRow.append($('<td>').text(registro.dia));
        newRow.append($('<td>').text(registro.horaingreso));
        newRow.append($('<td>').text(registro.horasalida));
        newRow.append($('<td>').text(registro.observacion));
        newRow.append($('<td>').html('<a id="'+registro.id+'" title="Eliminar" class="btn btn-sm btn-danger btn_eliminar_registro mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>'));
        tableBody.append(newRow);
        numero_orden++;
      });      
    }
    $("#tablamatriculas").on('click', '.btn_mostrar_horario', function() {
      var curso_id = $(this).attr('id'); 
      $.ajax({
        url: 'obtener-horarios',
        method: 'GET', // o GET, PUT, DELETE, según tus necesidades
        data: {id : curso_id},
        dataType: 'json', // o 'text', 'html', según el tipo de respuesta esperada
        success: function(respuesta) {
          $("#titulo-modalh").text('CURSO : ' + respuesta.curso[0].nombre);
              cargartablahorarios(respuesta);
            },
        error: function(xhr, status, error) {
          var mensajeError = "Ocurrió un error en la solicitud AJAX.";
          var mensajeDetallado = "Error: " + error + ", Estado: " + status + ", Descripción: " + xhr.statusText;
          $('#mensaje-error').text(mensajeError);
          console.log(mensajeDetallado);
        }
      });
      $("#modalhorario").modal('show');
    });


    function limpiarform(){
      $('input[name=id]').val(''); 
      $('input[name=nombre]').val('');  
      $('input[name=credito]').val('');  
      $('select[name=estado]').val('Libre');
      $('select[name=tipo]').val('Semestral');
      $('select[name=estadodocente]').val('PENDIENTE');
      $('input[name=codigo]').val('');
    }
    $("#horariostabla").on('click', '.btn_eliminar_registro', function() {            
        var registro_id = $(this).attr('id');       
        Swal.fire({
          icon: 'question',
          title: 'Asignacion',
          text: 'Esta Seguro de Eliminar el Registro?',
          toast: true,
          position: 'center',
          showConfirmButton: true,
          confirmButtonText: 'Si',
          showCancelButton: true,
          cancelButtonText: 'No',
          cancelButtonColor: '#bd2130'
        }).then(respuesta=>{
          if(respuesta.isConfirmed){
            $.ajax({
                type:'POST',
                dataType:'json',
                url: 'horario-eliminar',
                data: {
                  id: registro_id,
                  _token: csrf_token
                },
                success: function(data) {
                    if(data.ok==1)
                    {
                      toastr.success(data.mensaje)
                      $("#modalhorario").modal('hide');
                    }
                }
            })
            
          }
        });
    });

    $("#tablamatriculas").on('click', '.btn_agregar_horario', function() { 
      $('.alert-danger').remove();
      $("#titulo-modal").text('Agregar Horario');
      var curso_id = $(this).attr('id'); 
      $.ajax({
        url: 'curso-obtener',
        method: 'GET', // o GET, PUT, DELETE, según tus necesidades
        data: {id : curso_id},
        dataType: 'json', // o 'text', 'html', según el tipo de respuesta esperada
        success: function(respuesta) {
          $('input[name=curso_id]').val(curso_id)
          $('select[name=dia]').val('')
          $('input[name=horaingreso]').val('')
          $('input[name=horasalida]').val('')
          $('input[name=observacion]').val('')
        },
        error: function(xhr, status, error) {
          var mensajeError = "Ocurrió un error en la solicitud AJAX.";
        
        // Obtener información detallada del error
        var mensajeDetallado = "Error: " + error + ", Estado: " + status + ", Descripción: " + xhr.statusText;

        // Mostrar mensaje de error en algún elemento HTML
        $('#mensaje-error').text(mensajeError);
        
        // Mostrar mensaje detallado en la consola
        console.log(mensajeDetallado);
        }
      })
      $("#modalhorarioform").modal('show');
    });
</script>
@endsection





