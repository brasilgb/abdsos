<div class="col">
    <form id="" action="{{ route('tarefas.busca') }}" method="POST" class="inline">
        @csrf
        @method('POST')
        <div class="input-group">
            <select class="w-75 custom-select form-control " name="status" required>
                <option value="">Filtrar tarefas por status</option>
                <option value="1">Aberta</option>
                <option value="2">Execução</option>
                <option value="3">Fechada</option>
                <option value="4">Cancelada</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-search shadow-sm" type="submit"><i
                        class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="col">
<form action="{{ route('tarefas.busca') }}" method="post" class="inline">
    @method('POST')
    @csrf
    <div class="input-group mb-0">
        <input id="searchform" type="text" name="term" class="form-control shadow-sm"
            placeholder="Buscar tarefa por data" required>
        <div class="input-group-append">
            <button type="submit" class="btn btn-search shadow-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
</div>
