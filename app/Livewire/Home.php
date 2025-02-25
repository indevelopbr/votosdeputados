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
        $host = request()->getHost();

        if ($host === 'deputados.anistia08dejaneiro.com.br' || $host === 'www.deputados.anistia08dejaneiro.com.br') {
            $this->uri = 'anistia-dos-presos-politicos';
        } else {
            $this->uri = $uri;
        }
    }

    public function selectedUfId(string $uf) {
        $this->selectedUf = $uf;
    }

    public function render()
    {
        // Define a chave de cache com base na URI ou usa a chave padrão "voting"
        $cacheName = $this->uri ? $this->uri : 'voting';
    
        // Obtém a votação do cache ou, se não existir, executa a consulta e gera o cache
        $voting = Cache::remember($cacheName, 240, function () {
            return Voting::when($this->uri, function ($query) {
                        $query->where('voting_uri', $this->uri);
                    })
                    ->when(!$this->uri, function ($query) {
                        $query->where('main_vote', 1);
                    })
                    ->with(['votes.senator.party'])
                    ->first();
        });
    
        if (is_null($voting)) {
            return abort(404);
        }
    
        // Se houver filtro por UF, filtra os votos; caso contrário, usa todos
        $filteredVotes = $this->selectedUf
            ? $voting->votes->filter(function ($vote) {
                return isset($vote->senator) && $vote->senator->uf === $this->selectedUf;
            })
            : $voting->votes;
    
        // Separa e ordena os votos por tipo
        $inFavor    = $filteredVotes->where('vote', 'Y')->sortBy(fn($vote) => $vote->senator->name ?? '');
        $indefinite = $filteredVotes->where('vote', 'I')->sortBy(fn($vote) => $vote->senator->name ?? '');
        $against    = $filteredVotes->where('vote', 'N')->sortBy(fn($vote) => $vote->senator->name ?? '');
    
        // Seleciona a view (lembre-se de corrigir a condição de host, se necessário)
        $host = request()->getHost();
        dd($host);
        if ($host === 'deputados.anistia08dejaneiro.com.br' && $host === 'www.deputados.anistia08dejaneiro.com.br') {
            return view('livewire.home-two', [
                'title'      => $voting->name,
                'voting'     => $voting,
                'inFavor'    => $inFavor,
                'indefinite' => $indefinite,
                'against'    => $against,
            ])
            ->layout('components.layouts.guest')
            ->title($voting->name);
        } else {
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
}
