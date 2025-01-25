<div class="container">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Criar Nova Votação</h3>

        <!-- Mensagem de Sucesso -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo_votacao" class="form-label">Código da Votação</label>
                    <input type="text" id="codigo_votacao" class="form-control @error('codigo_votacao') is-invalid @enderror" wire:model="codigo_votacao">
                    @error('codigo_votacao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sigla_casa_colegiado" class="form-label">Sigla da Casa ou Colegiado</label>
                    <input type="text" id="sigla_casa_colegiado" class="form-control @error('sigla_casa_colegiado') is-invalid @enderror" wire:model="sigla_casa_colegiado">
                    @error('sigla_casa_colegiado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo_reuniao" class="form-label">Código da Reunião</label>
                    <input type="text" id="codigo_reuniao" class="form-control @error('codigo_reuniao') is-invalid @enderror" wire:model="codigo_reuniao">
                    @error('codigo_reuniao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="data_hora_inicio_reuniao" class="form-label">Data e Hora de Início da Reunião</label>
                    <input type="datetime-local" id="data_hora_inicio_reuniao" class="form-control @error('data_hora_inicio_reuniao') is-invalid @enderror" wire:model="data_hora_inicio_reuniao">
                    @error('data_hora_inicio_reuniao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="numero_reuniao_colegiado" class="form-label">Número da Reunião do Colegiado</label>
                    <input type="number" id="numero_reuniao_colegiado" class="form-control @error('numero_reuniao_colegiado') is-invalid @enderror" wire:model="numero_reuniao_colegiado">
                    @error('numero_reuniao_colegiado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipo_reuniao" class="form-label">Tipo de Reunião</label>
                    <input type="text" id="tipo_reuniao" class="form-control @error('tipo_reuniao') is-invalid @enderror" wire:model="tipo_reuniao">
                    @error('tipo_reuniao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="codigo_colegiado" class="form-label">Código do Colegiado</label>
                    <input type="text" id="codigo_colegiado" class="form-control @error('codigo_colegiado') is-invalid @enderror" wire:model="codigo_colegiado">
                    @error('codigo_colegiado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="sigla_colegiado" class="form-label">Sigla do Colegiado</label>
                    <input type="text" id="sigla_colegiado" class="form-control @error('sigla_colegiado') is-invalid @enderror" wire:model="sigla_colegiado">
                    @error('sigla_colegiado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-8 mb-3">
                    <label for="nome_colegiado" class="form-label">Nome do Colegiado</label>
                    <input type="text" id="nome_colegiado" class="form-control @error('nome_colegiado') is-invalid @enderror" wire:model="nome_colegiado">
                    @error('nome_colegiado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo_parlamentar_presidente" class="form-label">Código do Parlamentar Presidente</label>
                    <input type="text" id="codigo_parlamentar_presidente" class="form-control @error('codigo_parlamentar_presidente') is-invalid @enderror" wire:model="codigo_parlamentar_presidente">
                    @error('codigo_parlamentar_presidente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nome_parlamentar_presidente" class="form-label">Nome do Parlamentar Presidente</label>
                    <input type="text" id="nome_parlamentar_presidente" class="form-control @error('nome_parlamentar_presidente') is-invalid @enderror" wire:model="nome_parlamentar_presidente">
                    @error('nome_parlamentar_presidente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="identificacao_materia" class="form-label">Identificação da Matéria</label>
                    <input type="text" id="identificacao_materia" class="form-control @error('identificacao_materia') is-invalid @enderror" wire:model="identificacao_materia">
                    @error('identificacao_materia') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="descricao_identificacao_materia" class="form-label">Descrição da Identificação da Matéria</label>
                    <textarea id="descricao_identificacao_materia" class="form-control @error('descricao_identificacao_materia') is-invalid @enderror" wire:model="descricao_identificacao_materia" rows="3"></textarea>
                    @error('descricao_identificacao_materia') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="descricao_votacao" class="form-label">Descrição da Votação</label>
                <textarea id="descricao_votacao" class="form-control @error('descricao_votacao') is-invalid @enderror" wire:model="descricao_votacao" rows="4"></textarea>
                @error('descricao_votacao') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <h4>Total de Votos</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="total_votos_sim" class="form-label">Total de Votos Sim</label>
                    <input type="number" id="total_votos_sim" class="form-control @error('total_votos_sim') is-invalid @enderror" wire:model="total_votos_sim" min="0">
                    @error('total_votos_sim') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_votos_nao" class="form-label">Total de Votos Não</label>
                    <input type="number" id="total_votos_nao" class="form-control @error('total_votos_nao') is-invalid @enderror" wire:model="total_votos_nao" min="0">
                    @error('total_votos_nao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_votos_abstencao" class="form-label">Total de Votos Abstenção</label>
                    <input type="number" id="total_votos_abstencao" class="form-control @error('total_votos_abstencao') is-invalid @enderror" wire:model="total_votos_abstencao" min="0">
                    @error('total_votos_abstencao') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i> Salvar Votação
            </button>
        </form>
    </div>
</div>
