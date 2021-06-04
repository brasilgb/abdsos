<form id="form-search" action="{{ route('clientes.busca') }}" method="POST"
class="inline">
@csrf
@method('POST')
<div class="input-group">
    <input id="input-search" type="text" class="form-control rounded-left" name="term"
        placeholder="Buscar cliente" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
    <div class="input-group-append">
        <button class="btn btn-search shadow-sm" type="submit"><i class="fa fa-search"></i></button>
    </div>
</div>
</form>
<div class="autocomplete" style="display: none;">
<ul>
    <li></li>
</ul>
</div>
