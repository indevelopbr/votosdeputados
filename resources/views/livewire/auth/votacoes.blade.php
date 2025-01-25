<div x-data="{ open: @entangle('confirmingDelete') }">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Votações') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4"></h2>
            <a href="{{ route('votacoes.criar') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Nova Votação
            </a>
        </div>

        <!-- Mensagem de Sucesso -->
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        @endif

        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-10 mb-2">
                <input type="text" class="form-control" placeholder="Buscar livre..." wire:model.debounce.300ms="search">
            </div>
            <div class="col-md-2 mb-2">
                <select class="form-select" wire:model="perPage">
                    <option value="10">10 por página</option>
                    <option value="25">25 por página</option>
                    <option value="50">50 por página</option>
                </select>
            </div>
        </div>

        <!-- Tabela de Votações -->
        <div class="table-responsive" style="min-height: 300px;">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 90%">Descrição</th>
                        <th style="width: 10%" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($votings as $voting)
                        <tr>
                            <td>{{ $voting->nome_colegiado }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $voting->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Ações') }}
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $voting->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('votacoes.votos', $voting->id) }}">
                                                <i class="bi bi-eye me-2"></i>Votos</a>
                                            </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('votacoes.votos', $voting->id) }}">
                                            <i class="bi bi-pencil-square me-2"></i>Editar Votação</a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" @click.prevent="open = true" wire:click.prevent="confirmDelete({{ $voting->id }})"><i class="bi bi-trash me-2"></i>Excluir</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma votação encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $votings->links() }}
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" x-show="open" @keydown.escape.window="open = false" x-cloak>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" @click="open = false" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir esta votação?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="open = false">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteVoting">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</div>
