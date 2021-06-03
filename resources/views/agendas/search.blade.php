<div class="col">
    <form id="" action="{{ route('agendas.busca') }}" method="POST" class="inline">
        @csrf
        @method('POST')
        <div class="input-group">
            <select class="w-75 custom-select form-control " name="status">
                <option value="">Filtrar agendas por status</option>
                <option value="1">Aguardando atendimento</option>
                <option value="2">Em atendimento</option>
                <option value="3">Cancelado</option>
                <option value="4">Concluído</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-search shadow-sm" type="submit"><i
                        class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="col">
    <form id="form-search" action="{{ route('agendas.busca') }}" method="POST" class="inline">
    @csrf
    @method('POST')
    <div class="input-group">
        <input id="searchform" type="text" class="form-control rounded-left" name="term" placeholder="Buscar por data"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
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
</div>

