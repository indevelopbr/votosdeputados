<?php
namespace App\Services;

use App\Models\Party;
use App\Models\Senator;
use App\Models\Voting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class SenadorServices
{
    public $url;

    public function __construct()
    {
        $this->url = env('SENADO_DADOSABERTOS_URL'); 
    }

    public function get($url = null, $uri = null)
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL               => ($url ?? $this->url) . $uri,
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_ENCODING          => '',
            CURLOPT_MAXREDIRS         => 10,
            CURLOPT_TIMEOUT           => 0,
            CURLOPT_FOLLOWLOCATION    => true,
            CURLOPT_HTTP_VERSION      => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST     => 'GET',
            CURLOPT_HTTPHEADER        => array(
                'Accept: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        return $response;
    }

    public function getPartidos()
    {
        $response = $this->get(null, 'senador/partidos');

        return $response;
    }

    public function updatePartidos()
    {
        try {
            $partidos = json_decode($this->getPartidos(), true)['ListaPartidos']['Partidos']['Partido'];

            foreach ($partidos as $item) {

                if (!($item['DataExtincao'] ?? false)) {
                    if ($item['Sigla'] != 'S/Partido') {
                        // Muda a sigla para o formato sem acentos e caracteres especiais
                        $sigla = iconv('UTF-8', 'ASCII//TRANSLIT', $item['Sigla']);
                        $sigla = preg_replace('/[^a-zA-Z0-9]/', '', $sigla);
                        
                        $tempPartido = json_decode($this->get("https://dadosabertos.camara.leg.br/api/v2/partidos?sigla={$sigla}&ordem=ASC&ordenarPor=sigla"), true)['dados'];
                        $tempPartido = json_decode($this->get($tempPartido[0]['uri'] ?? null), true)['dados'] ?? [];

                        // Baixar imagem e salvar no storage
                        $logoUrl = $tempPartido['urlLogo'] ?? '';
                        $logoPath = null;

                        if ($logoUrl) {
                            $logoPath = $this->downloadImageLogoPartido($logoUrl, $item['Sigla']);
                        }
                    }
                }

                $partido = Party::updateOrCreate([
                    'id' => $item['Codigo']
                ]);

                $partido->update([
                    'name'              => $item['Nome'] ?? '',
                    'acronym'           => $item['Sigla'] ?? null,
                    'image_logo'        => $logoPath ?? null,
                    'foundation_date'   => $item['DataCriacao'] ?? null,
                    'data_extincao'     => $item['DataExtincao'] ?? null,
                ]);
                $partido->save();

                echo "Partido {$item['Sigla']} atualizado com sucesso!\n";
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function downloadImageLogoPartido($url, $sigla)
    {
        try {
            $imageContent = @file_get_contents($url);

            if ($imageContent) {
                $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $filename = "uploads/partidos/{$sigla}/logo." . ($extension ?: 'png'); // Default para PNG
                Storage::disk('public')->put($filename, $imageContent);

                return Storage::disk('public')->url($filename);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return null;
    }

    public function getSenadoresAtual()
    {
        $response = $this->get(null, 'senador/lista/atual');

        return $response;
    }

    public function updateSenadoresAtual()
    {
        try {
            $senadores = json_decode($this->getSenadoresAtual(), true)['ListaParlamentarEmExercicio']['Parlamentares']['Parlamentar'];

            foreach ($senadores as $item) {
                $senador = $item['IdentificacaoParlamentar'];

                if (($senador['UrlFotoParlamentar'] ?? '') != '') {
                    $imagePath = $this->downloadImageSenador($senador['UrlFotoParlamentar'] ?? '', $senador['SiglaPartidoParlamentar'] ?? '', $senador['NomeParlamentar'] ?? '');
                }

                $sigla = iconv('UTF-8', 'ASCII//TRANSLIT', $senador['SiglaPartidoParlamentar'] ?? '');
                $sigla = preg_replace('/[^a-zA-Z0-9]/', '', $sigla);

                $party = Party::where('acronym', $sigla)->first();

                $newSenador = Senator::updateOrCreate([
                    'id'            => (int) ($senador['CodigoParlamentar'] ?? 0),
                    'party_id'      => $party->id ?? null,
                ]);

                $newSenador->update([
                    'name'                  => $senador['NomeParlamentar'],
                    'email'                 => $senador['EmailParlamentar'],
                    //'birth_date'            => $item['DadosBasicosParlamentar']['DataNascimento'],
                    'phone'                 => '+5561' . $senador['Telefones']['Telefone'][0]['NumeroTelefone'],
                    'uf'                    => $senador['UfParlamentar'],
                    'image_profile'         => $imagePath ?? '',
                    'facebook'              => null,
                    'instagram'             => null,
                    'twitter'               => null,
                    'site'                  => null,
                    'birth_date'            => null,
                    're_election'           => $this->getFimMandado($item['Mandato']),
                ]);
                $newSenador->save();

                echo "Senador {$newSenador->name} atualizado com sucesso!\n";
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    private function downloadImageSenador($url, $sigla, $nome)
    {
        try {
            $imageContent = file_get_contents($url);
            if (!$imageContent) {
                return null;
            }
    
            $slugName = Str::slug($nome, '-');

            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($extension, $allowedExtensions)) {
                $extension = 'jpg';
            }
 
            $uniqueFilename = sprintf('%s-%s.%s', $slugName, uniqid(), $extension);
    
            $directory = "uploads/partidos/{$sigla}/senadores";
            $fullPath = "{$directory}/{$uniqueFilename}";

            $manager    = new ImageManager(Driver::class);
            $image      = $manager->read($imageContent);
            $encoded    = $image->encode(new AutoEncoder(quality: 75));

            $encodedBinary = (string) $encoded;

            Storage::disk('public')->put($fullPath, $encodedBinary);

            return Storage::disk('public')->url($fullPath);
    
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    
        return null;
    }

    public function getFimMandado($data)
    {
        if (!empty($data['SegundaLegislaturaDoMandato'])) {
            return Carbon::parse($data['SegundaLegislaturaDoMandato']['DataFim'])->format('Y-m-d');
        } else {
            return Carbon::parse($data['PrimeiraLegislaturaDoMandato']['DataFim'])->format('Y-m-d');
        }
    }

    public function updateVotacoesSenador($id)
    {
        $response = $this->get(null, "votacaoComissao/parlamentar/{$id}");
        $votacoes = json_decode($response, true)['VotacoesComissao']['Votacoes']['Votacao'];

        foreach ($votacoes as $votacao) {
            $exsiste = Voting::where('codigo_votacao', $votacao['CodigoVotacao'])->first();

            if ($exsiste) {
                continue;
            }

            $newVotacao = Voting::create([
                "codigo_votacao"                    => $votacao['CodigoVotacao'],
                "sigla_casa_colegiado"              => $votacao['SiglaCasaColegiado'],
                "codigo_reuniao"                    => $votacao['CodigoReuniao'],
                "data_hora_inicio_reuniao"          => $votacao['DataHoraInicioReuniao'],
                "numero_reuniao_colegiado"          => $votacao['NumeroReuniaoColegiado'],
                "tipo_reuniao"                      => $votacao['TipoReuniao'],
                "codigo_colegiado"                  => $votacao['CodigoColegiado'],
                "sigla_colegiado"                   => $votacao['SiglaColegiado'],
                "nome_colegiado"                    => $votacao['NomeColegiado'],
                "codigo_parlamentar_presidente"     => $votacao['CodigoParlamentarPresidente'],
                "nome_parlamentar_presidente"       => $votacao['NomeParlamentarPresidente'],
                "identificacao_materia"             => $votacao['IdentificacaoMateria'],
                "descricao_identificacao_materia"   => $votacao['DescricaoIdentificacaoMateria'],
                "descricao_votacao"                 => $votacao['DescricaoVotacao'],
                "total_votos_sim"                   => $votacao['TotalVotosSim'],
                "total_votos_nao"                   => $votacao['TotalVotosNao'],
                "total_votos_abstencao"             => $votacao['TotalVotosAbstencao'],
            ]);

            echo "Votação {$newVotacao->nome_colegiado} criada com sucesso!\n"; 

            $votos = $votacao['Votos']['Voto'];

            foreach ($votos as $voto) {
                $sigla = iconv('UTF-8', 'ASCII//TRANSLIT', $voto['SiglaPartidoParlamentar']);
                $sigla = preg_replace('/[^a-zA-Z0-9]/', '', $sigla);
                $dataReuniao = Carbon::parse($votacao['DataHoraInicioReuniao'])->format('Y-m-d');
                $partido = Voting::where('sigla', $sigla)
                    ->where('data_criacao', '<=', $dataReuniao)
                    ->where(function($query) use ($dataReuniao) {
                        $query->where('data_extincao', '>=', $dataReuniao)
                            ->orWhereNull('data_extincao');
                    })
                    ->first();

                $newVoto = $newVotacao->votos()->create([
                    "votacao_id"            => $newVotacao->id,
                    "senador_id"            => $voto['CodigoParlamentar'],
                    "partido_id"            => $partido->id,
                    "sigla_casa_parlamentar"=> $voto['SiglaCasaParlamentar'],
                    "qualidade_voto"        => $voto['QualidadeVoto'],
                    "voto_presidente"       => $voto['VotoPresidente'] === "false" ? false : true,
                ]);

                $senadorNome = $newVoto->senador->nome ?? '';

                echo "Voto do senador {$senadorNome} criado com sucesso!\n";
            }
        }
    }

    public function initUpdate()
    {
        //$this->updatePartidos();
        $this->updateSenadoresAtual();

        //foreach ($senadores as $senador) {
        //    $this->updateVotacoesSenador($senador->id);
        //}
    }
}
