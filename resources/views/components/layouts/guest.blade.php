<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="preload" href="{{ asset('assets/images/foto-moraes.png') }}" as="image">
        <title>{{ config('app.name') . $title }}</title>
        <meta name="robots" content="max-image-preview:large">
        <link rel="stylesheet" href="{{ asset('assets/css/header-footer-elementor.css?ver=1.6.42') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/frontend.min.css?ver=3.24.4') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css?ver=8.4.5') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/e-swiper.min.css?ver=3.24.4') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/frontend.min.css') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/uael-frontend.min.css?ver=1.36.34') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/post-807.css?ver=1726244872') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css?ver=3.1.1') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css?ver=3.1.1') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/header-footer.min.css?ver=3.1.1') }}" media="all">
        <link rel="stylesheet" href="{{ asset('assets/css/post-507.css') }}" media="all">
        <script src="{{ asset('assets/js/jquery.min.js') . '?ver=3.7.1' }}"></script>
        <script src="{{ asset('assets/js/jquery-migrate.min.js') . '?ver=3.4.1' }}"></script>
        <link rel="icon" href="{{ asset('assets/images/favicon-150x150.png') }}" sizes="32x32">
        <link rel="icon" href="{{ asset('assets/images/favicon-300x300.png') }}" sizes="192x192">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon-300x300.png') }}">
        <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon-300x300.png') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style id="wp-custom-css">
            .mapa.votos-container a {
                text-decoration: none;
            }
            .post-807 .page-header {
                display:none;
            }

            .wrap-votos .placar-titulo {
            font-size: 20px !important;
            font-weight: 500;
                color:#135899 !important;
                margin-top:40px;
            }

            .cards .votos-a-favor {
                border: none !important;
                background-image:none !important;
                background-color:#00a650 !important;
            }

            .cards .votos-a-favor .titulo {
                color:#fff;
                font-size:18px;
            }

            .cards .votos-a-favor .numero {
                color:#fff;
            }

            .cards .votos-abstencoes {
                border: none !important;
                background-image:none !important;
                background-color:#e4a00f !important;
            }

            .cards .votos-abstencoes .titulo {
                color:#fff;
                font-size:18px;
            }

            .cards .votos-abstencoes .numero {
                color:#fff;
            }

            .cards .votos-contra {
                border: none !important;
                background-image:none !important;
                background-color:#ed520d !important;
            }

            .cards .votos-contra .titulo {
                color:#fff;
                font-size:18px;
            }

            .cards .votos-contra .numero {
                color:#fff;
            }

            .mapa .mapa-regioes > a:hover svg, .mapa .mapa-regioes .active svg {
            filter: none !important
            }

            .mapa .mapa-regioes a svg {
            height: 95px !important;
            }

            .mapa .mapa-regioes a {
                font-size:14px;
                font-weight: normal;
            }

            section.votos-a-favor {
                width: 1140px;
            max-width: 100%;
            margin: 0 auto;
            padding-bottom: 40px;
                background-color:#fff !important;
            }
            .wrap-votos .votos-a-favor .tipo-titulo {
            --border-color-tipo-titulo: none !important;
            background-color: #f9f9f9 !important;
                border: 1px solid #ccc;
                border-radius:20px;
                margin-bottom:20px;
                color:#00a650;
                font-size:22px;
                font-weight:600;
            }
            .wrap-votos .votos-a-favor .tipo-titulo img {
                display:none;
            }

            section.votos-abstencoes {
                width: 1140px;
                max-width: 100%;
                margin: 0 auto;
                padding-bottom: 40px;
                background-color:#fff !important;
            }
            .wrap-votos .votos-abstencoes .tipo-titulo {
                --border-color-tipo-titulo: none !important;
                background-color: #f9f9f9 !important;
                border: 1px solid #ccc;
                border-radius:20px;
                margin-bottom:20px;
                color:#e4a00f;
                font-size:22px;
                font-weight:600;
            }
            .wrap-votos .votos-abstencoes .tipo-titulo img {
                display:none;
            }

            section.votos-abstencoes .parlamentar .imagem img {
                max-width:120px;
                max-height:120px;
                width: auto;
                height: auto;
                border:4px solid #e4a00f;
                text-align:center;
                padding: 3px;
            }

            section.votos-contra {
                width: 1140px;
                max-width: 100%;
                margin: 0 auto;
                padding-bottom: 40px;
                background-color:#fff !important;
            }
            .wrap-votos .votos-contra .tipo-titulo {
                --border-color-tipo-titulo: none !important;
                background-color: #f9f9f9 !important;
                border: 1px solid #ccc;
                border-radius:20px;
                margin-bottom:20px;
                color:#ed520d;
                font-size:22px;
                font-weight:600;
            }
            .wrap-votos .votos-contra .tipo-titulo img {
                display:none;
            }

            section.votos-contra .parlamentar .imagem img {
                max-width:120px;
                max-height:120px;
                width: auto;
                height: auto;
                border:4px solid #ed520d;
                text-align:center;
                padding: 3px;
            }

            @media (min-width: 1024px) {
            .wrap-votos {
                --grid-items: repeat(6, 1fr) !important;
            }
            }

            .wrap-votos .parlamentares .parlamentar {
                background-color: #fff !important;
                border: 10px solid white;
                justify-content: inherit !important;
                flex-direction: column;
                align-items: center;
                display: flex;
                width: 190px;
            }

            .wrap-votos .parlamentar {
                padding-bottom: 0px !important;
            }

            .wrap-votos .parlamentar .imagem {
                padding-top: 0px !important;
                background-color: #fff !important;
                display: flex;
            }
            .wrap-votos .parlamentar .imagem img {
                max-width:120px;
                max-height:120px;
                width: auto;
                height: auto;
                border:4px solid #00a650;
                text-align:center;
                padding: 3px;
            }
            .wrap-votos .parlamentar .titulo {
                font-size: 15px !important;
                text-transform: uppercase;
                text-align: center;
                padding:0px !important;
            }
            .wrap-votos .parlamentar .sigla {
                font-size: 11px !important;
                font-weight:400;
                text-align: center;
                padding:0px !important;
            }
            .wrap-votos .parlamentar .social-midia {
                margin: 0px !important;
                padding: 0 45px !important;
            }
            .wrap-votos .parlamentar .social-midia a {
                background-color: var(--color-icon);
                width: 20px !important;
                height: 20px !important;
            }
            .wrap-votos .parlamentar .social-midia a i, .wrap-votos .parlamentar .social-midia a svg {
                width: 10px !important;
                font-size: 10px !important;
            }

            section.votos .votos-container {
                padding-bottom: 0px !important;
            }

            .wrap-votos .tipo-titulo span:first-child {
                margin-right: 0px !important;
                padding-right: 0px !important;
            }

            .wrap-votos .modal .modal-inner [data-toggle-modal] {
                position: absolute;
                right: 25px !important;
                top: 15px !important;
                font-size: 30px !important;
                font-weight: bold;
            }

            .wrap-votos .modal .modal-inner {
                border-radius:10px !important;
            }

            .wrap-votos .modal .modal-inner div {
                border-radius:10px !important;
                border:1px solid #f1f1f1;
                background:#f9f9f9;
                padding:10px;
                margin-bottom:5px;
                width:100%;
                text-align: center;
            }

            .wrap-votos .modal .modal-inner div a {
                text-decoration:none;
            }

            @media (max-width: 1024px) {
                .elementor-710 .elementor-element.elementor-element-cffbacd {
                    padding: 30px 10px 30px 10px;
                }
                section.placar {
                    padding: 0 20px;
                }
                section.votos {
                    padding: 0 20px;
                }
                .wrap-votos {
                    --grid-items: repeat(2, 1fr) !important;
                }
                .wrap-votos .parlamentares .parlamentar {
                    width:178px;
                }
                .wrap-votos .parlamentar .social-midia {
                    padding: 0 37px !important;
                }
                .wrap-votos .modal .modal-inner {
                    margin:20px;
                }
            }
        </style>
    </head>
    <body class="home page-template-default page page-id-807 ehf-template-hello-elementor ehf-stylesheet-hello-elementor elementor-default elementor-kit-14 elementor-page elementor-page-807 e--ua-blink e--ua-edge e--ua-webkit" data-elementor-device-mode="desktop">
		<div data-elementor-type="header" data-elementor-id="710" class="elementor elementor-710 elementor-location-header" data-elementor-post-type="elementor_library">
            <section class="elementor-section elementor-top-section elementor-element elementor-element-169d11ea elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="169d11ea" data-element_type="section" id="topo" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-79b3a173" data-id="79b3a173" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-a50a199 elementor-widget elementor-widget-heading" data-id="a50a199" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <h2 class="elementor-heading-title elementor-size-default">
                                        <a href="https://www.change.org/p/impeachment-de-alexandre-de-moraes-pelo-bem-da-democracia" target="_blank" style="color: white">
                                            {{ __('Assine a maior petição pública pelo impeachment na história do Brasil! Meta: 5 milhões de assinaturas.') }}
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-9a1981b" data-id="9a1981b" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-5e61938 elementor-align-left elementor-tablet-align-center elementor-widget elementor-widget-button" data-id="5e61938" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="https://www.change.org/p/impeachment-de-alexandre-de-moraes-pelo-bem-da-democracia" target="_blank">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">ASSINAR</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-section elementor-top-section elementor-element elementor-element-d5c369f elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d5c369f" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-749a8cb" data-id="749a8cb" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-161855b elementor-widget elementor-widget-image" data-id="161855b" data-element_type="widget" data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <img src="{{ asset('assets/images/logo-votossenadores.png') }}" title="logo-votossenadores" alt="logo-votossenadores" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-section elementor-top-section elementor-element elementor-element-574b329 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="574b329" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6d0af0a" data-id="6d0af0a" data-element_type="column">
			            <div class="elementor-widget-wrap elementor-element-populated">
						    <div class="elementor-element elementor-element-44ece10 elementor-widget elementor-widget-heading" data-id="44ece10" data-element_type="widget" data-widget_type="heading.default">
				                <div class="elementor-widget-container">
			                        <h2 class="elementor-heading-title elementor-size-default">
                                        {{ __('Conheça a posição do seu Senador no:') }}
                                    </h2>
                                </div>
				            </div>
				            <div class="elementor-element elementor-element-3ac498e elementor-widget elementor-widget-heading" data-id="3ac498e" data-element_type="widget" data-widget_type="heading.default">
				                <div class="elementor-widget-container">
			                        <h2 class="elementor-heading-title elementor-size-default">
                                        {{ __('Impeachment de Alexandre de Moraes') }}
                                    </h2>
                                </div>
				            </div>
					    </div>
		            </div>
				    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-21faa2b" data-id="21faa2b" data-element_type="column">
			            <div class="elementor-widget-wrap elementor-element-populated">
						    <div class="elementor-element elementor-element-ad36cfc elementor-widget elementor-widget-image" data-id="ad36cfc" data-element_type="widget" data-widget_type="image.default">
				                <div class="elementor-widget-container">
                                    <img src="{{ asset('assets/images/foto-moraes.png') }}" title="foto-moraes" alt="foto-moraes" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <main id="content" class="site-main post-807 page type-page status-publish hentry">
            {{ $slot }}
        </main>

        <div data-elementor-type="footer" data-elementor-id="712" class="elementor elementor-712 elementor-location-footer" data-elementor-post-type="elementor_library">
			<div class="elementor-element elementor-element-f891df8 e-flex e-con-boxed e-con e-parent e-lazyloaded" data-id="f891df8" data-element_type="container" id="more-votes" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="e-con-inner">
				    <div class="elementor-element elementor-element-b04cafc elementor-widget elementor-widget-heading" data-id="b04cafc" data-element_type="widget" data-widget_type="heading.default">
				        <div class="elementor-widget-container">
			                <h2 class="elementor-heading-title elementor-size-default">Conheça a posição do seu deputado federal no Impeachment de Alexandre de Moraes</h2>
                        </div>
				    </div>
				    <div class="elementor-element elementor-element-1239397 elementor-align-center elementor-tablet-align-center elementor-widget elementor-widget-button" data-id="1239397" data-element_type="widget" data-widget_type="button.default">
				        <div class="elementor-widget-container">
					        <div class="elementor-button-wrapper">
			                <a class="elementor-button elementor-button-link elementor-size-sm" href="https://votosdeputados.com.br/" target="_blank">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Acessar Votos Deputados</span>
                                </span>
                            </a>
		                </div>
                    </div>
				</div>
            </div>
        </div>
		<div class="elementor-element elementor-element-12feac4 e-flex e-con-boxed e-con e-parent e-lazyloaded" data-id="12feac4" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="e-con-inner"  style="align-items: center;">
				<div class="elementor-element elementor-element-761b918 elementor-widget elementor-widget-heading" data-id="761b918" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default">Sobre o Votos Senadores</h2>
                    </div>
                </div>
				<div class="elementor-element elementor-element-27ed8ea elementor-widget elementor-widget-heading" data-id="27ed8ea" data-element_type="widget" data-widget_type="heading.default">
				    <div class="elementor-widget-container">
			            <h2 class="elementor-heading-title elementor-size-default">
                            Este site tem como objetivo apresentar as intenções de voto ou apoio dos senadores em exercício no Brasil aos projetos e pautas em discussão. Confira se eles estão honrando o voto que você, eleitor, depositou neles.
                        </h2>
                    </div>
				</div>
				<div class="elementor-element elementor-element-7ad2cf4 elementor-widget elementor-widget-image" data-id="7ad2cf4" data-element_type="widget" data-widget_type="image.default">
				    <div class="elementor-widget-container">
                        <img src="{{ asset('assets/images/logo-votossenadores-2.png') }}" title="logo-votossenadores-2" alt="logo-votossenadores-2" loading="lazy">													</div>
				    </div>
		            <div class="elementor-element elementor-element-e7abcd3 e-con-full e-flex e-con e-child" data-id="e7abcd3" data-element_type="container">
				        <div class="elementor-element elementor-element-951d8ff elementor-widget elementor-widget-heading" data-id="951d8ff" data-element_type="widget" data-widget_type="heading.default">
				            <div class="elementor-widget-container">
			                    <h2 class="elementor-heading-title elementor-size-default">© 2024 Direitos reservados</h2>
                            </div>
				        </div>
				    </div>
                </div>
            </div>
        </div>
    </body>
</html>