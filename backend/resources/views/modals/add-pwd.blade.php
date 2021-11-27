
<!-- Modal -->
<div class="modal fade" id="modal-pwrcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add.password')}}" method="POST" class="pawdr" >
          @csrf
          <div class="modal-body">
            <div id="p-info"></div>
            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" class="form-control" name="password" id="passw"  placeholder="Ingresa una contraseña" required>
            </div>
            <div class="form-group">
                <label>Confirma contraseña</label>
                <input type="password" class="form-control" id="pwd-confirm"  placeholder="Confirmar contraseña" required>
            </div>
            <input type="hidden" name="id" id="id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Asignar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  