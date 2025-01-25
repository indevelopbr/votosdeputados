<?php

namespace App\Livewire\Voting;

use App\Models\Senator;
use App\Models\Voting;
use Livewire\Component;
use Livewire\WithPagination;

class ListVotings extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $modalTitle = 'Nova Votação';
    public $name;
    public $selectedId;

    /**
     * Atualiza a numeração da página ao digitar no campo de busca.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Caso queira filtrar por título
        $votings = Voting::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.voting.list-votings', [
            'votings' => $votings,
        ])
        ->title(' - Votações'); // Caso esteja usando Inertia ou outro que suporte ->title()
    }

    /**
     * Exibe o modal para criar uma nova votação.
     */
    public function showCreateModal()
    {
        $this->resetFields();
        $this->modalTitle = 'Criar Votação';
        $this->showModal = true;
    }

    /**
     * Reseta campos do formulário do modal.
     */
    public function resetFields()
    {
        $this->name = '';
        $this->selectedId = null;
    }

    /**
     * Cria ou atualiza a votação.
     */
    public function createVotacao()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
        ]);

        // Se $selectedId estiver preenchido, faremos update, caso contrário, create.
        $voting = Voting::updateOrCreate(
            ['id' => $this->selectedId],
            ['name' => $this->name]
        );

        $senators = Senator::all();

        foreach ($senators as $senator) {
            $voting->votes()->updateOrCreate(
                ['senator_id' => $senator->id],
            );
        }

        $this->showModal = false;
        $this->resetFields();

        session()->flash('message', 'Votação salva com sucesso!');
    }

    /**
     * Abre o modal preenchido com os dados para edição.
     */
    public function edit($id)
    {
        $voting = Voting::findOrFail($id);

        $this->selectedId   = $voting->id;
        $this->name         = $voting->name;
        $this->modalTitle   = 'Editar Votação';
        $this->showModal    = true;
    }

    /**
     * Exclui uma votação do banco.
     */
    public function delete($id)
    {
        $voting = Voting::findOrFail($id);
        $voting->delete();

        session()->flash('message', 'Votação excluída com sucesso!');
    }

    /**
     * Fecha o modal sem salvar.
     */
    public function closeModal()
    {
        $this->showModal = false;
    }

    /**
     * Exemplo de ação para exibir detalhes de votos de determinada votação.
     * Ajuste conforme sua necessidade (pode ser redirecionamento, abrir outro modal, etc.).
     */
    public function showVotos($id)
    {
        // Exemplo: redirecionar para uma rota que exiba os votos
        return redirect()->route('votacoes.votos', $id);
    }
}
