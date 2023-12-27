<div class="modal fade" id="ver-paciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo_h4"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{'Cedula: '}}</strong><span id="cedula"></span>       
                            </div>
                            <div class="col-md-6">
                                <strong>{{'Teléfono: '}}</strong><span id="telefono"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="familiares" width="100%">
                            <thead>
                                <th>{{'Parentesco'}}</th>
                                <th>{{'Nombre'}}</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-transition btn btn-outline-secondary" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                     <i class="ti-back-left"></i>
                    </span>{{'Volver'}}
                </button>
            </div>
        </div>
    </div>
</div>
