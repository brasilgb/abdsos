<form id="form-search" action="{{ route('pecas.busca') }}" method="POST"
class="inline">
@csrf
@method('POST')
<div class="input-group">
    <input id="" type="text" class="peca form-control rounded-left" name="term"
        placeholder="Buscar por peça" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-search shadow-sm" type="submit"><i class="fa fa-search"></i></button>
    </div>
</div>
</form>
