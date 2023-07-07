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

@section('content-wrapper')
  <div class="content-wrapper">
    @include($content ?? 'paginas.docentes.inicio')
  </div>
  <!-- /.content-wrapper -->
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
@endsection


@section('script')
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script>
  let csrf_token = $('meta[name="csrf-token"]').attr('content');


    document.getElementById('docenteform').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        var form = document.getElementById('docenteform');
        $.ajax({
            type:'POST',
            // datatype: 'json',
            url: this.action,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
              form.reset();
              $("#modaldocente").modal('hide');
              cargar_datatable();
              toastr.success(data.mensaje)
              $('.alert-danger').remove();
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
      $("#tabladocentes").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tabladocentes_wrapper .col-md-6:eq(0)');
      cargar_datatable();
    }
    function cargar_datatable(){
      var table = $('#tabladocentes').DataTable();
      table.clear();
      $.ajax({
          dataType:'json',
          url: 'docentes-todos',
          success: function(data) {
            let numero_orden = 1;
              (data.docentes).forEach(function(repo) {
                  table.row.add([
                  numero_orden,
                  repo.dni,
                  repo.nombres,
                  repo.apellidos,
                  repo.sexo,
                  repo.tipocontrato,
                  '<div class="btn-group" role="group" aria-label="Basic mixed styles example"><a id="'+repo.id+'" class="btn btn-danger btn_eliminar_docente mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a><a id="'+repo.id+'" class="btn btn-warning btn_modificar_docente"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>'
                ]).draw();
                  numero_orden++;
              });
          }
      })
    }
    $("#tabladocentes").on('click', '.btn_eliminar_docente', function() {            
        var docente_id = $(this).attr('id');       
        Swal.fire({
          icon: 'question',
          title: 'Docente',
          text: 'Esta Seguro de Eliminar el docente?',
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
                url: 'docentes-eliminar',
                data: {
                  id: docente_id,
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

function limpiarformdocente(){
  $('input[name=id]').val('');
  $('input[name=nombres]').val('')
  $('input[name=apellidos]').val('')
  $('select[name=sexo]').val('M')
  $('input[name=dni]').val('')
  $('input[name=email]').val('')  
  $('select[name=tipocontrato]').val('Contratado')  
}

$('#btn-nuevo-docente').click(function (){
  limpiarformdocente();
  document.getElementById('grupocontrasenha').classList.remove('d-none');
  $("#titulo-modal").text('Nuevo Docente');
  $("#modaldocente").modal('show');
});

$("#tabladocentes").on('click', '.btn_modificar_docente', function() { 
  $('.alert-danger').remove();
  $("#titulo-modal").text('Modificar Docente');
  document.getElementById('grupocontrasenha').classList.add('d-none');
  var docente_id = $(this).attr('id'); 
  $.ajax({
    url: 'docente-obtener',
    method: 'GET', // o GET, PUT, DELETE, según tus necesidades
    data: {id : docente_id},
    dataType: 'json', // o 'text', 'html', según el tipo de respuesta esperada
    success: function(respuesta) {
      $('input[name=id]').val(respuesta.id)
      $('input[name=nombres]').val(respuesta.nombres)
      $('input[name=apellidos]').val(respuesta.apellidos)
      $('select[name=sexo]').val(respuesta.sexo)
      $('input[name=email]').val(respuesta.email)
      $('input[name=dni]').val(respuesta.dni)
      $('select[name=tipocontrato]').val(respuesta.tipocontrato)
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
  $("#modaldocente").modal('show');
});
</script>
@endsection






