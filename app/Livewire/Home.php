<?php

namespace App\Livewire;

use App\Models\Voting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Home extends Component
{
    public $uri;
    public $selectedUf;

    public function mount(string $uri = null)
    {
        $host = request()->getHost();

        // Se o host for o esperado, define a URI padrão
        if ($host == 'deputados.anistia08dejaneiro.com.br' || $host == 'www.deputados.anistia08dejaneiro.com.br') {
            $this->uri = 'anistia-dos-presos-politicos';
        } else {
            $this->uri = $uri;
        }
    }

    public function selectedUfId(string $uf)
    {
        $this->selectedUf = $uf;
    }

    public function render()
    {
        // Define a chave do cache com base na URI (ou "voting" como padrão)
        $cacheName = $this->uri ? $this->uri : 'voting';
        $cacheKey  = $cacheName . '_view';

        // Tenta recuperar o HTML da view no cache; se não existir, gera e armazena por 240 minutos
        $html = Cache::remember($cacheKey, 240, function () {
            // Consulta a votação com os relacionamentos necessários
            $voting = Voting::when($this->uri, function ($query) {
                        $query->where('voting_uri', $this->uri);
                    })
                    ->when(!$this->uri, function ($query) {
                        $query->where('main_vote', 1);
                    })
                    ->with(['votes.senator.party'])
                    ->first();

            if (is_null($voting)) {
                abort(404);
            }

            // Filtra os votos se uma UF foi selecionada
            $filteredVotes = $this->selectedUf
                ? $voting->votes->filter(function ($vote) {
                    return isset($vote->senator) && $vote->senator->uf === $this->selectedUf;
                })
                : $voting->votes;

            // Separa e ordena os votos por tipo
            $inFavor    = $filteredVotes->where('vote', 'Y')->sortBy(fn($vote) => $vote->senator->name ?? '');
            $indefinite = $filteredVotes->where('vote', 'I')->sortBy(fn($vote) => $vote->senator->name ?? '');
            $against    = $filteredVotes->where('vote', 'N')->sortBy(fn($vote) => $vote->senator->name ?? '');

            // Seleciona a view a ser renderizada de acordo com o host
            $host = request()->getHost();
            if ($host == 'deputados.anistia08dejaneiro.com.br' || $host == 'www.deputados.anistia08dejaneiro.com.br') {
                return view('livewire.home-two', [
                    'title'      => $voting->name,
                    'voting'     => $voting,
                    'inFavor'    => $inFavor,
                    'indefinite' => $indefinite,
                    'against'    => $against,
                ])->render();
            } else {
                return view('livewire.home', [
                    'title'      => $voting->name,
                    'voting'     => $voting,
                    'inFavor'    => $inFavor,
                    'indefinite' => $indefinite,
                    'against'    => $against,
                ])->render();
            }
        });

        return $html;
    }
}
