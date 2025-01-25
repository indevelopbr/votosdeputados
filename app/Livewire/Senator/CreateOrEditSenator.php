<?php

namespace App\Livewire\Senator;

use App\Models\Party;
use App\Models\Senator;
use App\Models\Voting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrEditSenator extends Component
{
    use WithFileUploads;

    // ID do senador para edição
    public $senatorId;

    // Campos
    public $name;
    public $email;
    public $phone;
    public $uf;
    public $image_profile;
    public $facebook;
    public $instagram;
    public $twitter;
    public $site;
    public $birth_date;
    public $re_election;
    public $re_election_date;
    public $party_id;

    public function mount(Senator $senator)
    {
        if ($senator) {
            $this->senatorId       = $senator->id;
            $this->name            = $senator->name;
            $this->email           = $senator->email;
            $this->phone           = $senator->phone;
            $this->uf              = $senator->uf;
            // Se estiver guardando apenas o path da imagem (mostrar preview no Blade, se quiser)
            // $this->image_profile = $senator->image_profile;
            $this->facebook        = $senator->facebook;
            $this->instagram       = $senator->instagram;
            $this->twitter         = $senator->twitter;
            $this->site            = $senator->site;
            $this->birth_date      = Carbon::parse($senator->birth_date)->format('Y-m-d');
            $this->re_election     = Carbon::parse($senator->re_election)->format('Y-m-d');
            $this->party_id        = $senator->party_id;
        }
    }

    public function saveSenator()
    {
        // Validações
        $this->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'uf'                => 'required|string|max:2',
            'image_profile'     => 'nullable|image|max:2048', // caso queira upload
            'facebook'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'twitter'           => 'nullable|string|max:255',
            'site'              => 'nullable|url|max:255',
            'birth_date'        => 'nullable|date',
            're_election'       => 'nullable|date',
            'party_id'          => 'nullable|exists:parties,id',
        ]);

        if ($this->senatorId) {
            // Edição
            $senator = Senator::findOrFail($this->senatorId);
        } else {
            // Criação
            $senator = new Senator();
        }

        // Atribui valores
        $senator->name             = $this->name;
        $senator->email            = $this->email;
        $senator->phone            = $this->phone;
        $senator->uf               = $this->uf;

        // Faz o upload (se houver nova imagem)
        if ($this->image_profile) {
            $path = $this->image_profile->store('senators', 'public');
            $senator->image_profile = $path;
        }

        $senator->facebook         = $this->facebook;
        $senator->instagram        = $this->instagram;
        $senator->twitter          = $this->twitter;
        $senator->site             = $this->site;
        $senator->birth_date       = $this->birth_date;
        $senator->re_election      = $this->re_election ?? false;
        $senator->party_id         = $this->party_id;
        $senator->save();

        session()->flash('message', 'Senador salvo com sucesso!');

        Cache::forget('voting'); // remove a chave antiga
        $voting = Voting::with(['votes.senator.party'])->first();
        Cache::put('voting', $voting, 60); // grava a nova versão por 60s

        // Redireciona para a lista (ajuste a rota conforme seu projeto)
        return redirect()->route('senadores');
    }

    public function render()
    {
        // Listar partidos (ajuste conforme sua lógica)
        $parties = Party::all();

        return view('livewire.senator.create-or-edit-senator', [
            'parties' => $parties,
        ]);
    }
}
