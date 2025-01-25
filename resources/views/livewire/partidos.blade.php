<div>
    <div class="container mt-5 filter-container">
        <h1 class="text-center mb-4">Partidos Políticos no Senado</h1>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control filter-input" wire:model.live="search" placeholder="Busca livre...">
            </div>
            <div class="col-md-4 col-sm-12">
                <select wire:model.live="selectedPartidoId" class="form-select filter-select" id="filterParty">
                    <option value="" selected>Todos os partido</option>
                    @foreach ($partidos as $partido)
                        <option value="{{ $partido->id }}">{{ $partido->sigla . ' - ' . $partido->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Grid de Partidos -->
    <div class="container">
        <div class="row g-4" id="partiesGrid">
            @forelse ($listPartidos as $item)
            <div class="col-md-4 col-lg-3">
                <div class="card text-center d-flex flex-column justify-content-center" style="height: 250px;">
                    <!-- Imagem do Partido -->
                    <img src="{{ $item->logo ?? '#' }}" class="card-img-top p-3 mt-4" alt="Logo {{ $item->nome }}" style="height: 75px; object-fit: contain;">
                    <!-- Corpo do Card -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nome }}</h5>
                        <p class="card-text">{{ $item->senadores->count() }} Senadores</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <div class="text-center">Nenhum partido encontrado</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
