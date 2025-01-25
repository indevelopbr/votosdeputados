<?php

namespace App\Livewire;

use App\Models\Partido;
use Livewire\Component;

class Partidos extends Component
{

public $partidos;

    public $search;
    public $selectedPartidoId = '';

    public function mount()
    {
        $this->partidos = Partido::select([
                'id',
                'sigla',
                'nome'
            ])
            ->whereNull('data_extincao')
            ->get();    
    }

    public function render()
    {
        $listPartidos = Partido::with('senadores')
            ->withCount('senadores')  // Conta os senadores para cada partido
            ->when($this->search, function ($query) {
                // Filtra os senadores e partidos com base no campo de busca
                $query->whereHas('senadores', function ($query) {
                    $query->where('nome', 'like', "%{$this->search}%")
                        ->orWhere('sigla', 'like', "%{$this->search}%")
                        ->orWhere('nome_completo', 'like', "%{$this->search}%");
                })
                ->orWhere('nome', 'like', "%{$this->search}%"); // Filtra pelo nome do partido
            })
            ->when($this->selectedPartidoId, function ($query) {
                $query->where('id', $this->selectedPartidoId); // Filtra pelo partido selecionado
            })
            ->whereNull('data_extincao')
            ->orderByDesc('senadores_count')  // Ordena pelos senadores de forma decrescente
            ->get();
    
        return view('livewire.partidos', [
            'listPartidos' => $listPartidos
        ]);
    }
}
