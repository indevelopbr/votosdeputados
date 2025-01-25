<div>
    <div class="page-header">
        <h1 class="entry-title">{{ __('Impeachment de Alexandre de Moraes') }}</h1>
    </div>
    <div class="page-content">
        <div data-elementor-type="wp-page" data-elementor-id="807" class="elementor elementor-807" data-elementor-post-type="page">
            <div class="elementor-element elementor-element-245b4d75 e-con-full e-flex e-con e-parent e-lazyloaded" data-id="245b4d75" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-element elementor-element-774048b5 elementor-widget elementor-widget-shortcode" data-id="774048b5" data-element_type="widget" data-widget_type="shortcode.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-shortcode">
                            <div class="wrap-votos">
                                <section class="mapa votos-container" style="margin-top: 3rem">
                                    <div class="mapa-regioes">
                                        <a href="https://votossenadores.com.br/" class="mapa-brasil active">
                                            <picture>
                                                <x-icones.map-brazil />
                                            </picture>
                                            <span>{{ __('Brasil') }}</span>
                                        </a>
                                        <a href="#" data-toggle-modal="#modal-norte" class="">
                                            <picture>
                                                <x-icones.map-north-brazil />
                                            </picture>
                                            <span>{{ __('Norte') }}</span>
                                        </a>
                                        <a href="#" data-toggle-modal="#modal-centro-oeste" class="">
                                            <picture>
                                                <x-icones.map-central-west-brazil />
                                            </picture>
                                            <span>{{ __('Centro-Oeste') }}</span>
                                        </a>
                                        <a href="#" data-toggle-modal="#modal-nordeste" class="">
                                            <picture>
                                                <x-icones.map-northeast-brazil />
                                            </picture>
                                            <span>{{ __('Nordeste') }}</span>
                                        </a>
                                        <a href="#" data-toggle-modal="#modal-sul" class="">
                                            <picture>
                                                <x-icones.map-south-brazil />
                                            </picture>
                                            <span>{{ __('Sul') }}</span>
                                        </a>
                                        <a href="#" data-toggle-modal="#modal-sudeste" class="">
                                            <picture>
                                                <x-icones.map-southeast-brazil />
                                            </picture>
                                            <span>{{ __('Sudeste') }}</span>
                                        </a>
                                    </div>
                                </section>
                                <section class="placar">
                                    <h2 class="placar-titulo">{{ __("Placar Nacional ") . ($voting->name ?? '') }}</h2>
                                    <div class="cards">
                                        <a href="#inFavor" style="text-decoration: none;">
                                            <div class="card votos-a-favor">
                                                <div class="titulo">{{ __('A FAVOR') }}</div>
                                                <span class="numero" data-duration="2000" data-to-value="{{ $inFavor->count() }}" data-from-value="0" data-delimiter=",">
                                                    {{ $inFavor->count() }}
                                                </span>
                                            </div>
                                        </a>
                                        <a href="#indefinite" style="text-decoration: none;">
                                            <div class="card votos-abstencoes">
                                                <div class="titulo">{{ __('INDEFINIDOS') }}</div>
                                                <span class="numero" data-duration="2000" data-to-value="{{ $indefinite->count() }}" data-from-value="0" data-delimiter=",">
                                                    {{ $indefinite->count() }}
                                                </span>
                                            </div>
                                        </a>
                                        <a href="#against" style="text-decoration: none;">
                                            <div class="card votos-contra">
                                                <div class="titulo">{{ __('CONTRA') }}</div>
                                                <span class="numero" data-duration="2000" data-to-value="{{ $against->count() }}" data-from-value="0" data-delimiter=",">
                                                    {{ $against->count() }}
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </section>
                                <section class="votos votos-a-favor" id="inFavor">
                                    <h3 class="tipo-titulo">
                                        <span>{{ __('VOTOS A FAVOR') }}</span>
                                        <span>
                                            <img decoding="async" src="{{ asset('assets/images/icon.png') }}">
                                        </span>
                                    </h3>
                                    <div class="parlamentares votos-container">
                                        @foreach ($inFavor as $vote)
                                            <div class="parlamentar">
                                                <div class="imagem">
                                                    <img loading="lazy" decoding="async" src="{{$vote->senator->image_profile }}" width="99" height="120" alt="Avatar de Alan Rick">
                                                </div>    
                                                <div class="titulo">{{ $vote->senator->name }}</div>
                                                <div class="titulo" style="margin: 0; font-weight: 700; font-size: 12px !important; text-transform: none !important;">
                                                    {{ __('Reeleição: ') . $vote->senator->getReElection() }}
                                                </div>
                                                <div class="sigla">{{ $vote->senator->party->name . ' - ' . $vote->senator->uf }}</div>
                                                <div class="social-midia">
                                                    @if ($vote->senator->facebook)
                                                        <a href="{{ $vote->senator->facebook }}" style="text-decoration: none;">
                                                            <i class="bi bi-facebook"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->instagram)
                                                        <a href="{{ $vote->senator->instagram }}" style="text-decoration: none;">
                                                            <i class="bi bi-instagram"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->twitter)
                                                        <a href="{{ $vote->senator->twitter }}" style="text-decoration: none;">
                                                            <i class="bi bi-twitter-x"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->site)
                                                        <a href="{{ $vote->senator->site }}" style="text-decoration: none;">
                                                            <i class="bi bi-browser-edge"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->phone)
                                                        <a href="{{ $vote->senator->phone }}" style="text-decoration: none;">
                                                            <i class="bi bi-telephone"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                                <section class="votos votos-abstencoes" id="indefinidos">
                                    <h3 class="tipo-titulo">
                                        <span>{{ __('INDEFINIDOS') }}</span>
                                        <span><img decoding="async" src="{{ asset('assets/images/icon.png') }}"></span>
                                    </h3>
                                    <div class="parlamentares votos-container">
                                        @foreach ($indefinite as $vote)
                                            <div class="parlamentar">
                                                <div class="imagem">
                                                    <img loading="lazy" decoding="async" src="{{$vote->senator->image_profile }}" width="99" height="120" alt="Avatar de Alan Rick">
                                                </div>    
                                                <div class="titulo">{{ $vote->senator->name }}</div>
                                                <div class="titulo" style="margin: 0; font-weight: 700; font-size: 12px !important; text-transform: none !important;">
                                                    {{ __('Reeleição: ') . $vote->senator->getReElection() }}
                                                </div>
                                                <div class="sigla">{{ $vote->senator->party->name . ' - ' . $vote->senator->uf }}</div>
                                                <div class="social-midia">
                                                    @if ($vote->senator->facebook)
                                                        <a href="{{ $vote->senator->facebook }}" style="text-decoration: none;">
                                                            <i class="bi bi-facebook"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->instagram)
                                                        <a href="{{ $vote->senator->instagram }}" style="text-decoration: none;">
                                                            <i class="bi bi-instagram"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->twitter)
                                                        <a href="{{ $vote->senator->twitter }}" style="text-decoration: none;">
                                                            <i class="bi bi-twitter-x"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->site)
                                                        <a href="{{ $vote->senator->site }}" style="text-decoration: none;">
                                                            <i class="bi bi-browser-edge"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->phone)
                                                        <a href="{{ $vote->senator->phone }}" style="text-decoration: none;">
                                                            <i class="bi bi-telephone"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                                <section class="votos votos-contra" id="contra">
                                    <h3 class="tipo-titulo">
                                        <span>VOTOS CONTRA</span>
                                        <span>
                                            <img decoding="async" src="{{ asset('assets/images/icon.png') }}">
                                        </span>
                                    </h3>
                                    <div class="parlamentares votos-container">
                                        @foreach ($against as $vote)
                                            <div class="parlamentar">
                                                <div class="imagem">
                                                    <img loading="lazy" decoding="async" src="{{$vote->senator->image_profile }}" width="99" height="120" alt="Avatar de Alan Rick">
                                                </div>    
                                                <div class="titulo">{{ $vote->senator->name }}</div>
                                                <div class="titulo" style="margin: 0; font-weight: 700; font-size: 12px !important; text-transform: none !important;">
                                                    {{ __('Reeleição: ') . $vote->senator->getReElection() }}
                                                </div>
                                                <div class="sigla">{{ $vote->senator->party->name . ' - ' . $vote->senator->uf }}</div>
                                                <div class="social-midia">
                                                    @if ($vote->senator->facebook)
                                                        <a href="{{ $vote->senator->facebook }}" style="text-decoration: none;">
                                                            <i class="bi bi-facebook"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->instagram)
                                                        <a href="{{ $vote->senator->instagram }}" style="text-decoration: none;">
                                                            <i class="bi bi-instagram"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->twitter)
                                                        <a href="{{ $vote->senator->twitter }}" style="text-decoration: none;">
                                                            <i class="bi bi-twitter-x"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->site)
                                                        <a href="{{ $vote->senator->site }}" style="text-decoration: none;">
                                                            <i class="bi bi-browser-edge"></i>
                                                        </a>
                                                    @endif
                                                    @if ($vote->senator->phone)
                                                        <a href="{{ $vote->senator->phone }}" style="text-decoration: none;">
                                                            <i class="bi bi-telephone"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                                <div id="modal-norte" class="modal">
                                    <div class="modal-inner">
                                        <div>
                                            <h3>{{ __('Norte') }}</h3>
                                            <a href="#" data-toggle-modal="#modal-norte">×</a>
                                        </div>
                                        <div><a href="#" wire:click="selectedUfId('AC')">{{ __('Acre') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('AP')">{{ __('Amapá') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('AM')">{{ __('Amazonas') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('PA')">{{ __('Pará') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('RO')">{{ __('Rondônia') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('RR')">{{ __('Roraima') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('TO')">{{ __('Tocantins') }}</a></div>
                                    </div>
                                </div>

                                <div id="modal-nordeste" class="modal">
                                    <div class="modal-inner">
                                        <div>
                                            <h3>{{ __('Nordeste') }}</h3>
                                            <a href="#" data-toggle-modal="#modal-nordeste">×</a>
                                        </div>
                                        <div><a href="#" wire:click="selectedUfId('AL')">{{ __('Alagoas') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('BA')">{{ __('Bahia') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('CE')">{{ __('Ceará') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('MA')">{{ __('Maranhão') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('PB')">{{ __('Paraíba') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('PE')">{{ __('Pernambuco') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('PI')">{{ __('Piauí') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('RN')">{{ __('Rio Grande do Norte') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('SE')">{{ __('Sergipe') }}</a></div>
                                    </div>
                                </div>

                                <div id="modal-centro-oeste" class="modal">
                                    <div class="modal-inner">
                                        <div>
                                            <h3>{{ __('Centro-Oeste') }}</h3>
                                            <a href="#" data-toggle-modal="#modal-centro-oeste">×</a>
                                        </div>
                                        <div><a href="#" wire:click="selectedUfId('DF')">{{ __('Distrito Federal') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('GO')">{{ __('Goiás') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('MT')">{{ __('Mato Grosso') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('MS')">{{ __('Mato Grosso do Sul') }}</a></div>
                                    </div>
                                </div>

                                <div id="modal-sul" class="modal">
                                    <div class="modal-inner">
                                        <div>
                                            <h3>{{ __('Sul') }}</h3>
                                            <a href="#" data-toggle-modal="#modal-sul">×</a>
                                        </div>
                                        <div><a href="#" wire:click="selectedUfId('PR')">{{ __('Paraná') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('RS')">{{ __('Rio Grande do Sul') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('SC')">{{ __('Santa Catarina') }}</a></div>
                                    </div>
                                </div>

                                <div id="modal-sudeste" class="modal">
                                    <div class="modal-inner">
                                        <div>
                                            <h3>{{ __('Sudeste') }}</h3>
                                            <a href="#" data-toggle-modal="#modal-sudeste">×</a>
                                        </div>
                                        <div><a href="#" wire:click="selectedUfId('ES')">{{ __('Espírito Santo') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('MG')">{{ __('Minas Gerais') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('RJ')">{{ __('Rio de Janeiro') }}</a></div>
                                        <div><a href="#" wire:click="selectedUfId('SP')">{{ __('São Paulo') }}</a></div>
                                    </div>
                                </div>

                            </div>
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

                                .wrap-votos {
                                    --color-gray: #666;
                                    --color-icon: #838384ff;
                                    --color-voto-favor: #009C3B;
                                    --color-voto-abstencoes: #FFC222;
                                    --color-voto-contra: #BA1717;
                                    --color-accent: rgb(8, 19, 64);
                                    --color-sigla: rgb(25, 113, 62);
                                    --bg-voto-favor: #daf7e2ff;
                                    --bg-voto-abstencoes: #f4f3dcff;
                                    --bg-voto-contra: #f7e4e4ff;
                                    --grid-items: 1fr;
                                    --card-flex-direction: column;
                                    --wrap-cards-flex-direction: column;
                                    --card-score-width: 100%;
                                }

                                @media (min-width: 468px) {
                                    .wrap-votos {
                                        --grid-items: repeat(2, 1fr);
                                    }
                                }

                                @media (min-width: 768px) {
                                    .wrap-votos {
                                        --grid-items: repeat(3, 1fr);
                                        --card-flex-direction: row;
                                        --wrap-cards-flex-direction: row;
                                        --card-score-width: 282px;
                                    }
                                }

                                @media (min-width: 1024px) {
                                    .wrap-votos {
                                        --grid-items: repeat(4, 1fr);
                                    }
                                }

                                .wrap-votos .votos-a-favor {
                                    --bg-icon: var(--color-voto-favor);
                                    background-color: var(--bg-voto-favor);
                                }

                                .wrap-votos .votos-abstencoes {
                                    --bg-icon: var(--color-voto-abstencoes);
                                    background-color: var(--bg-voto-abstencoes);
                                }

                                .wrap-votos .votos-contra {
                                    --bg-icon: var(--color-voto-contra);
                                    background-color: var(--bg-voto-contra);
                                }

                                .wrap-votos section {
                                    padding-bottom: 40px;
                                    margin-bottom: 0;
                                }

                                .wrap-votos .votos-container {
                                    display: flex;
                                    width: 1140px;
                                    max-width: 100%;
                                    margin: 0 auto;
                                    padding-bottom: 40px;
                                }

                                .wrap-votos .placar-titulo {
                                    margin-bottom: 40px;
                                    font-size: 28px;
                                    text-align: center;
                                    text-transform: uppercase;
                                    color: var(--color-gray);
                                }

                                .wrap-votos .tipo-titulo {
                                    font-size: 34px;
                                    text-align: center;
                                    padding: 10px 0;
                                    margin: 0 0 40px 0;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    gap: 10px;
                                    position: relative;
                                    color: white;
                                }

                                .wrap-votos .tipo-titulo::before,
                                .wrap-votos .tipo-titulo::after {
                                    content: "";
                                    height: 3px;
                                    display: block;
                                    position: absolute;
                                    background-color: var(--border-color-tipo-titulo);
                                    left: 0;
                                    right: 0;
                                }

                                .wrap-votos .tipo-titulo span:first-child {
                                    border-right: 2px solid rgba(255, 255, 255, .2);
                                    margin-right: 15px;
                                    padding-right: 25px;
                                }

                                .wrap-votos .tipo-titulo::before {
                                    top: 0;
                                }

                                .wrap-votos .tipo-titulo::after {
                                    bottom: 0;
                                }

                                .wrap-votos .votos-a-favor .tipo-titulo {
                                    --border-color-tipo-titulo: #1aff4aff;
                                    background-color: var(--color-voto-favor);
                                }

                                .wrap-votos .votos-abstencoes .tipo-titulo {
                                    --border-color-tipo-titulo: #ffff00ff;
                                    background-color: var(--color-voto-abstencoes);
                                }

                                .wrap-votos .votos-contra .tipo-titulo {
                                    --border-color-tipo-titulo: #ff0000ff;
                                    background-color: var(--color-voto-contra);
                                }

                                .mapa {
                                    flex-wrap: wrap;
                                }

                                .mapa a.mapa-brasil {
                                    border-right: 2px solid #eee;
                                    padding-right: 25px;
                                }

                                .mapa .mapa-regioes {
                                    display: flex;
                                    justify-content: center;
                                    flex-grow: 1;
                                    flex-wrap: wrap;
                                    gap: 35px;
                                }

                                .mapa .mapa-regioes a {
                                    display: grid;
                                    text-align: center;
                                    text-transform: uppercase;
                                    justify-content: center;
                                    font-weight: bold;
                                    color: var(--color-gray);
                                }

                                .mapa .mapa-regioes a svg {
                                    margin: 0 auto;
                                }

                                .mapa .mapa-regioes a svg {
                                    height: 130px;
                                    width: auto;
                                    transition: all .3s linear;    
                                }

                                .mapa .mapa-regioes a svg * {
                                    fill: var(--color-gray) !important;
                                    stroke: #fff !important;
                                }

                                .mapa .mapa-regioes > a:hover svg,
                                .mapa .mapa-regioes .active svg {
                                    filter: drop-shadow(-3px 10px 1px var(--color-sigla));
                                }

                                .mapa .mapa-regioes > a:hover svg *,
                                .mapa .mapa-regioes .active svg * {
                                    fill: #00a650ff !important;
                                }

                                .wrap-votos .card.votos-a-favor {
                                    --bg-color: var(--color-voto-favor);
                                }

                                .wrap-votos .card.votos-abstencoes {
                                    --bg-color: var(--color-voto-abstencoes);
                                }

                                .wrap-votos .card.votos-contra {
                                    --bg-color: var(--color-voto-contra);
                                }

                                .wrap-votos .cards .card[class*=votos-] {
                                    font-family: "Poppins", sans-serif;
                                    background-image: linear-gradient(-30deg, transparent 65%, transparent 1px, rgba(255, 255, 255, .3) 35%);
                                    background-repeat: no-repeat;
                                    background-color: var(--bg-color);
                                    width: var(--card-score-width);
                                    max-width: 100%;
                                    border-radius: 26px;
                                    display: grid;
                                    grid-template-columns: repeat(2, 1fr);
                                    justify-content: center;
                                    color: white;
                                    flex-direction: var(--card-flex-direction);
                                    padding: 4px 8px;
                                    gap: 15px;
                                    border: 2px solid #ddd;
                                }

                                .wrap-votos .cards .card[class*=votos-] > :first-child {
                                    border-right: 1px solid rgba(221, 221, 221, .6);
                                }

                                .wrap-votos .cards .card[class*=votos-] > * {
                                    display: flex;
                                    align-items: center;
                                    justify-items: center;
                                }

                                .wrap-votos .cards {
                                    display: flex;
                                    gap: 30px;
                                    justify-content: center;
                                    flex-direction: var(--wrap-cards-flex-direction);
                                    flex-wrap: wrap;
                                }

                                .wrap-votos .numero {
                                    font-size: 64px;
                                    line-height: 64px;
                                    font-weight: bold;
                                    text-align: center;
                                    padding-right: 10px;
                                    justify-content: center;
                                }

                                .wrap-votos .titulo {
                                    font-size: 15px;
                                    padding: 0 10px;
                                }

                                .wrap-votos .parlamentares {
                                    display: grid;
                                    grid-template-columns: var(--grid-items);
                                }

                                .wrap-votos .parlamentares .parlamentar {
                                    background-color: #d8d8d8ff;
                                    border: 10px solid white;
                                    justify-content: center;
                                    flex-direction: column;
                                    align-items: center;
                                    display: flex;
                                }

                                .wrap-votos .parlamentar .social-midia {
                                    margin: 20px 0;
                                    padding: 0 40px;
                                    vertical-align: middle;
                                    justify-content: space-around;
                                    align-items: center;
                                    display: flex;
                                    gap: 10px;   
                                    width: 100%;

                                }

                                .wrap-votos .parlamentar .social-midia a {
                                    background-color: var(--color-icon);
                                    width: 35px;
                                    height: 35px;
                                    border-radius: 999px;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .wrap-votos .parlamentar .social-midia a i,
                                .wrap-votos .parlamentar .social-midia a svg {
                                    width: 16px;
                                    font-size: 16px;
                                    color: white;
                                    fill: white;
                                }

                                .wrap-votos .parlamentar .sigla {
                                    font-size: 13px;
                                    font-family: Poppins, sans-serif;
                                    margin-bottom: 10px;
                                }

                                .wrap-votos .parlamentar .titulo {
                                    font-size: 20px;
                                    font-family: Poppins, sans-serif;
                                    color: var(--color-gray);
                                    margin-top: 10px;
                                }

                                .wrap-votos .parlamentar {
                                    border: 1px solid rgb(221, 221, 221);
                                    padding-bottom: 15px;
                                }

                                .wrap-votos .parlamentar .imagem {
                                    padding-top: 20px;
                                    background-color: var(--bg-icon);
                                    display: flex;
                                }

                                .wrap-votos .parlamentar .icone {
                                    background-color: var(--bg-icon);
                                    width: 30px;
                                    aspect-ratio: 1/1;
                                    color: white;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    padding: 2px;
                                    border-radius: 999px;
                                }

                                .wrap-votos .modal {
                                    position: fixed;
                                    inset: 0;
                                    justify-content: center;
                                    align-items: center;
                                    z-index: 9999;
                                    background-color: rgb(0, 0, 0, .1);
                                    display: none;
                                }

                                .wrap-votos .modal.open {
                                    display: flex;
                                }

                                .wrap-votos .modal .modal-inner {
                                    background-color: white;
                                    border: 1px solid #eee;
                                    box-shadow: 3px 3px 3px rgb(0, 0, 0, .1), -1px -1px 4px rgb(6, 6, 6, .1);
                                    display: flex;
                                    padding: 15px;
                                    width: 500px;
                                    min-height: 300px;
                                    max-width: 100%;
                                    justify-content: center;
                                    align-items: center;
                                    flex-direction: column;
                                    position: relative;
                                }

                                .wrap-votos .modal .modal-inner [data-toggle-modal] {
                                    position: absolute;
                                    right: 5px;
                                    top: 5px;
                                    font-size: 25px;
                                    font-weight: bold;
                                }

                                .wrap-votos .modal .modal-inner h3{
                                    color: var(--color-gray);
                                }
                                </style>
                                <script>
                                    document.querySelectorAll('[data-toggle-modal').forEach((el) => {
                                        el.addEventListener('click', (e) => {
                                            e.preventDefault();
                                            document.querySelector(el.getAttribute('data-toggle-modal')).classList.toggle('open');
                                        })
                                    })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</div>