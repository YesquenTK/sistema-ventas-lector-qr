<div id="modalcategoria" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="producto_form_cat">
                <div class="modal-header">
                  <h4 class="modal-tittle" id="mdltitulo_cat"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cat_id" name="cat_id">

                     <div class="form-group">
                        <label class="form-label" for="cat_nom">Nombre</label>
                        <input type="text" class="form-control" id="cat_nom" name="cat_nom" placeholder="Ingrese Nombre de la categoria" required>
                     </div>
                     <div class="form-group">
                        <label class="form-label" for="cat_des">Descripcion</label>
                        <input type="text" class="form-control" id="cat_des" name="cat_des" placeholder="Ingrese la descripcion" required>
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="guardar_categoria" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
           </form>
       </div> 
    </div>
</div>