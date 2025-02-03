<?php

namespace App\Livewire\Voting;

use App\Models\Senator;
use App\Models\Voting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;

class ListVotings extends Component
{
    use WithPagination, WithFileUploads;

    public $search       = '';
    public $showModal    = false;
    public $modalTitle   = 'Nova Votação';
    public $name;
    public $selectedId;
    public $file;        // O arquivo que será enviado
    public $isMain = false;

    /**
     * Atualiza a numeração da página ao digitar no campo de busca.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filtra pelo 'name' e ordena
        $votings = Voting::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.voting.list-votings', [
            'votings' => $votings,
        ])
        ->title(' - Votações'); 
    }

    /**
     * Exibe o modal para criar uma nova votação.
     */
    public function showCreateModal()
    {
        $this->resetFields();
        $this->modalTitle = 'Criar Votação';
        $this->showModal  = true;
    }

    /**
     * Reseta campos do formulário do modal.
     */
    public function resetFields()
    {
        $this->name       = '';
        $this->file       = null;
        $this->isMain     = false;
        $this->selectedId = null;
    }

    /**
     * Cria ou atualiza a votação.
     */
    public function createVotacao()
    {
        // Validação básica. Ajuste conforme necessidade.
        $this->validate([
            'name' => 'required|min:3|max:255',
            'file' => 'nullable|image|max:2048', 
        ]);

        // Caso haja imagem, faz o upload
        $imageUrl = null;
        if ($this->file) {
            $imageUrl = $this->uploadImage($this->file);
            $array['image_url'] = $imageUrl;
        }

        $uri = Str::slug($this->name);

        $array['name'] = $this->name;
        $array['voting_uri'] = $uri;
        $array['main_vote'] = $this->isMain;

        // Cria ou atualiza a votação
        $voting = Voting::updateOrCreate(
            ['id' => $this->selectedId],
            $array
        );

        // Assegura que todos os senadores tenham relação de voto nesta votação
        $senators = Senator::all();
        foreach ($senators as $senator) {
            $voting->votes()->updateOrCreate(
                ['senator_id' => $senator->id],
                // campos adicionais na pivot, se necessário
            );
        }

        // Fecha modal e limpa campos
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

        $this->selectedId = $voting->id;
        $this->name       = $voting->name;
        $this->isMain     = $voting->main_vote;
        // Em caso de edição, se quiser exibir preview da imagem, 
        // você poderia salvar em outra propriedade para preview.
        // $this->file    = $voting->image;  // Ex: guardando a URL caso precise
       
        $this->modalTitle = 'Editar Votação';
        $this->showModal  = true;
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
     */
    public function showVotos($id)
    {
        return redirect()->route('votacoes.votos', $id);
    }

    /**
     * Faz o upload e processamento da imagem usando Intervention Image.
     */
    private function uploadImage($file)
    {
        try {
            // Exemplo de nome usando slug do título (caso queira relacionar)
            $slugName  = Str::slug($this->name, '-');
            $extension = $file->getClientOriginalExtension();

            // Exemplo: "titulo-da-votacao-637c2265ba57a.jpg"
            $uniqueFilename = sprintf('%s-%s.%s', $slugName, uniqid(), $extension);

            $directory = 'uploads/votings';
            $fullPath  = "{$directory}/{$uniqueFilename}";

            // Processamento com Intervention
            $manager = new ImageManager(Driver::class);
            
            // Carrega a imagem do caminho temporário e faz encode com qualidade de 75
            $image = $manager->read($file->getRealPath())->encode(new AutoEncoder(quality: 75));

            // Salva no disco 'public'
            Storage::disk('public')->put($fullPath, (string) $image);

            // Retorna a URL pública
            return Storage::disk('public')->url($fullPath);
        } catch (\Exception $e) {
            // Em caso de erro, faça o debug ou trate a exceção conforme necessário
            dd($e->getMessage());
        }

        return null;
    }
}
