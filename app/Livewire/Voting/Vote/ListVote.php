<?php

namespace App\Livewire\Voting\Vote;

use App\Models\Senator;
use App\Models\Vote;
use App\Models\Voting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class ListVote extends Component
{
    use WithPagination;

    public Voting $voting;

    // Filtros
    public $filterName  = '';
    public $filterParty = '';
    public $filterUf    = '';

    public $voto = [];

    // Sempre que o usuário digitar algo nos filtros, reseta a paginação
    public function updatingFilterName()  { $this->resetPage(); }
    public function updatingFilterParty() { $this->resetPage(); }
    public function updatingFilterUf()    { $this->resetPage(); }

    /**
     * Detecta mudanças em qualquer propriedade (inclusive no array $voto).
     * Se for uma mudança no radio (ex: "voto.15"), salva o valor no banco.
     */
    public function updated($property, $value)
    {
        $exploded = explode('.', $property);
        // Se a propriedade iniciada é algo como "voto.XXX"
        if ($exploded[0] === 'voto') {
            // Extrai o ID do Vote
            $voteId = (int) $exploded[1];

            $vote = Vote::find($voteId);
            if ($vote) {
                $vote->vote = $value;  // Ex: "A FAVOR", "Contra" ou "Indefinido"
                $vote->save();
            }

            Cache::forget('voting'); // remove a chave antiga
            $voting = Voting::with(['votes.senator.party'])->first();
            Cache::put('voting', $voting, 60); // grava a nova versão por 60s
        }
    }

    public function render()
    {
        // Filtra os registros
        $query = Vote::with('senator.party')
            ->where('voting_id', $this->voting->id);

        if ($this->filterName) {
            $query->whereHas('senator', function ($q) {
                $q->where('name', 'like', '%'.$this->filterName.'%')
                  ->orWhere('uf', 'like', '%'.$this->filterName.'%');
            });
        }
        if ($this->filterParty) {
            $query->whereHas('senator', function ($q) {
                $q->whereHas('party', function ($q1) {
                    $q1->where('name', 'like', '%'.$this->filterParty.'%');
                });
            });
        }
        if ($this->filterUf) {
            $query->whereHas('senator', function ($q) {
                $q->where('uf', 'like', '%'.$this->filterUf.'%');
            });
        }

        // Ordena pelo nome do senador usando subselect, caso Laravel 8+
        $query->orderBy(
            Senator::select('name')
                ->whereColumn('senators.id', 'votes.senator_id')
                ->limit(1),
            'asc'
        );

        foreach ($query->get() as $vote) {
            $this->voto[$vote->id] = $vote->vote;
        }

        // Pega os registros (sem paginação ou com, se preferir)
        $votes = $query->get();

        return view('livewire.voting.vote.list-vote', compact('votes'));
    }
}
