<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="preload" href="{{ asset('assets/images/foto-moraes.png') }}" as="image">
        <title>{{ config('app.name') . ' - ' . $title }}</title>
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
        {{ $slot }}
    </body>
</html>