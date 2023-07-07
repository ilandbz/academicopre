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
    document.getElementById('nuevodocente').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        var form = document.getElementById('nuevodocente');
        $.ajax({
            type:'POST',
            // datatype: 'json',
            url: this.action,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
              
              form.reset();
              $("#modalnuevodocente").modal('hide');
              $("#tabladocentes-body").empty();
              carga_inicial();
              // window.location.href="docentes"
              // toastr.success(data.mensaje)
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
      //$("#example1 > tbody").empty();
      $.ajax({
          dataType:'json',
          url: 'docentes/todos',
          success: function(data) {
              let numero_orden = 1;
              (data.docentes).forEach(function(repo) {
                  agregarFila(numero_orden,repo)
                  numero_orden++;
              });
          }
      })
    } 
    function agregarFila(numero_orden, tabla){      
      var fila = '<tr>';
      fila += '<td>'+numero_orden+'</td>';
      fila += '<td>'+tabla.dni +'</td>';        
      fila += '<td>'+tabla.nombres+'</td>'; 
      fila += '<td>'+tabla.apellidos+'</td>'; 
      fila += '<td>'+tabla.sexo+'</td>';         
      fila += '<td>'+tabla.tipocontrato+'</td>';         
      fila += '<td>';

      fila += '</td>';
      fila += '</tr>';
      $("#tabladocentes").append(fila);    
    }
      $("#tabladocentes").on('click', '.btn_eliminar_docente', function() {            
          var docente_id = $(this).attr('id'); 
          console.log(docente_id);          
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
                        //($("#tabladocentes > tbody").empty();
                        //carga_inicial();
                        //window.location.href="docentes"
                    
                      }
                  }
              })
              
            }
          });
      });
$(function () {
  $("#tabladocentes").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#tabladocentes_wrapper .col-md-6:eq(0)');
});
</script>
@endsection






