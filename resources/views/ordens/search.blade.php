
            <div class="col">
                <form id="" action="{{ route('ordens.busca') }}" method="POST" class="inline">
                    @csrf
                    @method('POST')
                    <div class="input-group">
                        <select class="w-75 custom-select form-control " name="status" required>
                            <option value="">Filtrar ordens por status</option>
                            <option value="1">Em avaliação</option>
                            <option value="2">Orçamento gerado</option>
                            <option value="3">Orçamento aprovado</option>
                            <option value="4">Na bancada</option>
                            <option value="5">Serviço concluído</option>
                            <option value="6">Serviço não efetuado</option>
                            <option value="7">Ordem fechada</option>
                            <option value="8">Equipamento entregue</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-search shadow-sm" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col">
                <form id="form-search" action="{{ route('ordens.busca') }}" method="POST"
                    class="inline">
                    @csrf
                    @method('POST')
                    <div class="input-group">
                        <input id="input-search" type="text" name="term" class="form-control rounded-left"
                            name="term" placeholder="Buscar ordem" required>
                        <div class="input-group-append">
                            <button class="btn btn-search shadow-sm" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="autocomplete" style="display: none;">
                    <ul>
                        <li></li>
                    </ul>
                </div>
            </div>
