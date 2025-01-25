<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Votos') }}
        </h2>
    </x-slot>

    <!-- Mensagem de Sucesso -->
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    <div class="container mt-5">
        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" placeholder="Buscar por nome" wire:model.debounce.300ms="search">
            </div>
            <div class="col-md-4 mb-2">
                <select class="form-select" wire:model="filterParty">
                    <option value="">Filtrar por Partido</option>
                    @foreach($parties as $party)
                        <option value="{{ $party }}">{{ $party }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <select class="form-select" wire:model="filterUf">
                    <option value="">Filtrar por UF</option>
                    @foreach($ufs as $uf)
                        <option value="{{ $uf }}">{{ $uf }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Tabela de Senadores -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Partido</th>
                        <th>UF</th>
                        <th class="text-center">Voto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($votos as $voto)
                        <tr>
                            <td>{{ $voto->senador->nome ?? ''}}</td>
                            <td>{{ $voto->senador->partido->nome ?? '' }}</td>
                            <td>{{ $voto->uf ?? '' }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="selectedVote" id="sim_{{ $voto->id }}" value="S">
                                        <label class="form-check-label" for="sim_{{ $voto->id }}">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="votes.{{ $voto->id }}" id="nao_{{ $voto->id }}" value="N">
                                        <label class="form-check-label" for="nao_{{ $voto->id }}">Não</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="votes.{{ $voto->id }}" id="abstencao_{{ $voto->id }}" value="A">
                                        <label class="form-check-label" for="abstencao_{{ $voto->id }}">Abstêm</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="votes.{{ $voto->id }}" id="nao_voto_{{ $voto->id }}" value="">
                                        <label class="form-check-label" for="nao_voto_{{ $voto->id }}">Não Voto</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhum senador encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    <!-- Paginação e Botão de Salvar Votos -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <label for="perPage" class="form-label me-2">Itens por página:</label>
            <select id="perPage" class="form-select d-inline-block w-auto" wire:model="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div>
            <button class="btn btn-primary" wire:click="saveVotes">
                <i class="bi bi-save me-2"></i> Salvar Votos
            </button>
        </div>
    </div>
    </div>
</div>
