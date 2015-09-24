{{-------------- Bootstrap Modal ----------------}}

<div class="modal fade" id="modal-principal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Título</h4>
      </div>
      <div class="modal-body">
        <p>Texto</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" id="btn-principal" class="btn btn-primary" data-id="" data-dismiss="modal">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{---------------- /Bootstrap Modal --------------}}

{{-- Form oculto para enviar as requisições de exclusão dos usuários --}}

<form action="{{ url('users/') }}" method="POST" id="form-excluir-usuario">
  {!! csrf_field() !!}
  {!! method_field('DELETE') !!}
  <input type="hidden" value="" name="id" id="user_id">
</form>

{{-- Form oculto para enviar as requisições de exclusão das empresas --}}

<form action="{{ url('empresas/') }}" method="POST" id="form-excluir-empresa">
  {!! csrf_field() !!}
  {!! method_field('DELETE') !!}
  <input type="hidden" value="" name="id" id="empresa_id">
</form>