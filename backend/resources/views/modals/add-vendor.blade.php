
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('import.vendors')}}" method="POST" enctype="multipart/form-data" id="addform">
        @csrf
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" name="vendor" class="custom-file-input" id="inputGroupFile01" accept=".txt,.csv,.xlsx ," required  >
              <label class="custom-file-label" for="inputGroupFile01">Selecciona documento .txt o .csv</label>
            </div>
          </div>
          <b>Nota : Para importar los proveedores en formato txt favor de tomar el siguiente ejemplo
          <a href="{{asset('/storage/default/import_example.txt')}}" target="_blank" >Import_example.txt</a></b>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary"  >Importar</button>
        </div>
      </form>
    </div>
  </div>
</div>
