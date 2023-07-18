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
        <h3 class="card-title">Lista General de Programas de Estudio</h3>
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
                  <button class="btn btn-lg btn-warning" id="btn-nuevo-usuario">
                      Nuevo Registro <i class="fas fa-user-plus"></i>
                  </button>
              </div>
          </div>
        <br>
        @include('paginas.programas.tabla')
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@include('paginas.programas.modalprograma')
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


    document.getElementById('programaform').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        var form = document.getElementById('programaform');
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
              $("#modalprograma").modal('hide');
              cargar_datatable();
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
    $("#tablaprogramas").on('click', '.actordes', function() {
      var programa_id = $(this).attr('id');  
      event.preventDefault();
        $.ajax({
            dataType:'json',
            url: 'programas-cambiar-estado',
            data: {
                  id: programa_id,
                  _token: csrf_token
                },
            success: function(data) {
              cargar_datatable();
              toastr.success(data.mensaje)
            },
            error: function(xhr) {


            }
        });

    });

    
    carga_inicial();
    function carga_inicial(){ 
      $("#tablaprogramas").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tablaprogramas_wrapper .col-md-6:eq(0)');
      cargar_datatable();
    }
    function cargar_datatable(){
      var table = $('#tablaprogramas').DataTable();
      table.clear();
      $.ajax({
          dataType:'json',
          url: 'programas-todos',
          success: function(data) {
            let numero_orden = 1;
              (data.programas).forEach(function(repo) {
                  table.row.add([
                  numero_orden,
                  repo.nombre,
                  repo.aula.nombre,
                  repo.vacantes,
                  repo.es_activo==1 ? '<a id="'+repo.id+'" href="" class="actordes"><i class="nav-icon far fa-circle text-success"></i>&nbsp;'+
                  '<label class="text-success">Activo</label></a>' : '<a id="'+repo.id+'" href="" class="actordes"><i class="nav-icon far fa-circle text-muted"></i>&nbsp;'+
                  '<label class="text-muted">Inactivo</label></a>',
                  '<div class="btn-group" role="group" aria-label="Basic mixed styles example">'+
                    '<a id="'+repo.id+'" class="btn btn-danger btn_eliminar_programa mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                    '<a id="'+repo.id+'" class="btn btn-warning btn_modificar_programa mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                  '</div>'
                  
                ]).draw();
                  numero_orden++;
              });
          }
      })
    }
    $("#tablaprogramas").on('click', '.btn_eliminar_programa', function() {            
        var programa_id = $(this).attr('id');       
        Swal.fire({
          icon: 'question',
          title: 'Programas Educativos',
          text: 'Esta Seguro de Eliminar el Programa?',
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
                url: 'programas-eliminar',
                data: {
                  id: programa_id,
                  _token: csrf_token
                },
                success: function(data) {
                    if(data.ok==1)
                    {
                      toastr.success(data.mensaje)
                      cargar_datatable();
                    }
                }
            })
            
          }
        });
    });


function limpiarform(){
  $('input[name=nombre]').val('');  
  $('select[name=aula_id]').val('')
  $('input[name=vacantes]').val('')
  $('select[name=semestre_id]').val(1)  
}

$('#btn-nuevo-usuario').click(function (){
  limpiarform();
  $("#titulo-modal").text('Nuevo Programa');
  $("#modalprograma").modal('show');
});

$("#tablaprogramas").on('click', '.btn_modificar_programa', function() { 
  $('.alert-danger').remove();
  $("#titulo-modal").text('Modificar Programa');
  var programa_id = $(this).attr('id'); 
  $.ajax({
    url: 'programas-obtener',
    method: 'GET', // o GET, PUT, DELETE, según tus necesidades
    data: {id : programa_id},
    dataType: 'json', // o 'text', 'html', según el tipo de respuesta esperada
    success: function(respuesta) {
      $('input[name=id]').val(respuesta.id)
      $('input[name=nombre]').val(respuesta.nombre)
      $('select[name=aula_id]').val(respuesta.aula_id)
      $('input[name=vacantes]').val(respuesta.vacantes)
      $('select[name=semestre_id]').val(respuesta.semestre_id)
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
  $("#modalprograma").modal('show');
});
</script>
@endsection





