<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form method="post" id="producto_form">
        <div class="modal-header">
          <h4 class="modal-tittle" id="mdltitulo"></h4>
        </div>
        
        <div class="modal-body" style="max-height: 950px">
          <input type="hidden" id="id" name="id">

          <div class="form-group">
            <label class="form-label" for="cat_id">Categoria</label>
            <select class="form-control select2" id="cat_id" name="cat_id"></select>
          </div>

          <div class="form-group ">
            <label class="form-label" for="codigo">Codigo</label>
            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="Ingrese Codigo" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="producto">Nombre</label>
            <input type="text" class="form-control" id="producto" name="producto" placeholder="Ingrese Nombre" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese el Precio"
              required>
          </div>
          <div class="form-group">
            <label class="form-label" for="prod_cant">Cantidad</label>
            <input type="number" class="form-control" id="prod_cant" name="prod_cant" placeholder="Ingrese la Cantidad"
              required>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="producto_imagen">Imagen del Producto</label>
                <div class="dropzone">
                  <div class="dz-default dz-message">
                    <button class="dz-button" type="button">
                    <img id="producto_imagen" src="../../assets/img/default.jpg" alt="Imagen del producto" style="max-width: 150px; height: auto;">
                      
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="producto_qr">Imagen del Código QR</label>
                <div id="dropzoneQR" class="dropzone">
                    <div class="dz-default dz-message">
                        <button id="uploadQR" class="dz-button" type="button">
                            <img id="producto_qr" src="../../assets/subir.jpg" alt="LogoSubidaQR" style="max-width: 150px; height: auto;"></img>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
