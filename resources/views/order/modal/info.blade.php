<div id="modal_info" class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h4 class="modal-title" id="idTitle">{{ 'Pedido ' }}</h4>
                <form action="{{ route('order.pdf') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-ligth"><i class="ri-download-cloud-line"></i></button>
                </form>

                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-3">
                <div class="espacio_modal col-12">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ 'Datos del Cliente' }}</h3>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="control-label">RIF:</label><br>
                                        <label class="control-label">Razón Social:</label><br>
                                        <label class="control-label">Contacto:</label><br>
                                        <label class="control-label">Segmento:</label><br>
                                        <label class="control-label">SICM/SADA:</label><br>
                                        <label class="control-label">Teléfono:</label><br>
                                        <label class="control-label">Email:</label><br>
                                        <label class="control-label">Dirección:</label>
                                    </div>
                                    <div class="col-8">
                                        <span id="rif"></span><br>
                                        <span id="rs"></span><br>
                                        <span id="contacto"></span><br>
                                        <span id="seg"></span><br>
                                        <span id="sada"></span><br>
                                        <span id="tel"></span><br>
                                        <span id="email"></span><br>
                                        <span id="dir"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3>{{ 'Datos de la orden' }}</h3>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="control-label">Pedido:</label><br>
                                        <label class="control-label">Fecha:</label><br>
                                        <label class="control-label">Estado:</label>
                                    </div>
                                    <div class="col-8">
                                        <span id="pedido"></span><br>
                                        <span id="fecha"></span><br>
                                        <span id="estado"></span>
                                    </div>
                                </div>
                            </div><br>
                            <h3>{{ 'Datos del vendedor' }}</h3>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="control-label">Cedula:</label><br>
                                        <label class="control-label">Nombre:</label><br>
                                        <label class="control-label">Teléfono:</label>
                                    </div>
                                    <div class="col-8">
                                        <span id="cedula"></span><br>
                                        <span id="nombre"></span><br>
                                        <span id="telefono"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <h3>{{ 'Detalle del pedido' }}</h3>
                            <table id="detalle_info" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo">
                                </tbody>
                                <tfoot id="footer">
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
