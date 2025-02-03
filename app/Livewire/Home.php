<?php

namespace App\Livewire;

use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Home extends Component
{
    public $uri;
    public $selectedUf;

    public function mount(String $uri = null)
    {
        $this->uri = $uri;
    }

    public function selectedUfId(string $uf) {
        $this->selectedUf = $uf;
    }

    public function render()
    {
        $cacheName = $this->uri ? $this->uri : 'voting';

        // Obtém a votação do cache ou busca no banco
        $voting = Cache::remember($cacheName, 60, function () {
            return Voting::when($this->uri, function ($query) {
                $query->where('voting_uri', $this->uri);
            })
            ->when(!$this->uri, function ($query) {
                $query->where('main_vote', 1);
            })
            ->with(['votes.senator.party'])->first();
        });

        if (is_null($voting)) {
            return abort(404);
        }

        // Verifica se há uma votação disponível
        if (!$voting) {
            return view('livewire.home', [
                'voting'     => null,
                'inFavor'    => collect(),
                'indefinite' => collect(),
                'against'    => collect(),
            ])
            ->layout('components.layouts.guest')
            ->title('Votação não encontrada');
        }

        if ($this->selectedUf) {
            // Filtra os votos com base na UF selecionada
            $filteredVotes = $voting->votes->filter(function ($vote) {
                // Certifique-se de que a relação está carregada corretamente
                return isset($vote->senator) 
                    && $vote->senator->uf === $this->selectedUf;
            });
        } else {
            $filteredVotes = $voting->votes;
        }
        // Separa os votos por tipo
        $inFavor = $filteredVotes->where('vote', 'Y')->sortBy(fn($vote) => $vote->senator->name ?? '');
        $indefinite = $filteredVotes->where('vote', 'I')->sortBy(fn($vote) => $vote->senator->name ?? '');
        $against = $filteredVotes->where('vote', 'N')->sortBy(fn($vote) => $vote->senator->name ?? '');

        return view('livewire.home', [
            'title'      => $voting->name,
            'voting'     => $voting,
            'inFavor'    => $inFavor,
            'indefinite' => $indefinite,
            'against'    => $against,
        ])
        ->layout('components.layouts.guest')
        ->title($voting->name);
    }
}
