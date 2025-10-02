<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UmuPrime Imóveis - Sua imobiliária de confiança em Umuarama">
    <title>@yield('title', 'UmuPrime Imóveis - Sua casa dos sonhos está aqui')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #FFD700; /* Amarelo da logo */
            --secondary-color: #000000; /* Preto da logo */
            --accent-color: #FFA500;   /* Laranja complementar */
            --text-dark: #333333;
            --text-light: #666666;
            --bg-light: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* ======= TOP BAR (somente Instagram) ======= */
        .header-top {
            background-color: var(--secondary-color);
            color: #fff;
            padding: 8px 0;
            font-size: 14px;
        }
        .ig-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ig-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            color: #fff;
            text-decoration: none;
            transition: all .25s ease;
            font-weight: 500;
        }
        .ig-pill i { font-size: 16px; }
        .ig-pill:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-1px);
            color: #fff;
        }

        /* Header / Navbar */
        .navbar {
            background-color: #fff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        .navbar-brand img { height: 50px; }
        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover { color: var(--primary-color) !important; }

        /* Hero (dinâmico com a imagem do painel) */
        .hero-section {
            background:
                linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('{{ \App\Models\SiteSetting::singleton()->hero_image_url }}');
            background-size: cover;
            background-position: center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            color: #fff;
            text-align: center;
        }
        .hero-content h1 {
            font-size: 3.5rem; font-weight: 700; margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .hero-content p {
            font-size: 1.3rem; margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Search Form */
        .search-form {
            background: #fff; padding: 30px; border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: -50px; position: relative; z-index: 10;
        }
        .search-form .form-control, .search-form .form-select {
            border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px;
            font-size: 16px; transition: border-color 0.3s ease;
        }
        .search-form .form-control:focus, .search-form .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
        }

        /* Botão primário */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--secondary-color);
            font-weight: 600; padding: 12px 30px; border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            transform: translateY(-2px);
        }

        /* Cards de imóveis */
        .property-card {
            background: #fff; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }
        .property-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .property-image { height: 250px; background-size: cover; background-position: center; position: relative; }
        .property-badge {
            position: absolute; top: 15px; left: 15px;
            background: var(--primary-color); color: var(--secondary-color);
            padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
        }
        .property-price {
            position: absolute; bottom: 15px; right: 15px;
            background: rgba(0,0,0,0.8); color: #fff;
            padding: 8px 15px; border-radius: 20px; font-weight: 600;
        }
        .property-info { padding: 20px; }
        .property-title { font-size: 18px; font-weight: 600; margin-bottom: 10px; color: var(--text-dark); }
        .property-location { color: var(--text-light); font-size: 14px; margin-bottom: 15px; }
        .property-features { display: flex; gap: 15px; margin-bottom: 15px; }
        .feature-item { display: flex; align-items: center; gap: 5px; font-size: 14px; color: var(--text-light); }

        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed; width: 60px; height: 60px;
            bottom: 40px; right: 40px; background-color: #25d366; color: #fff;
            border-radius: 50px; text-align: center; font-size: 30px;
            box-shadow: 2px 2px 3px #999; z-index: 100; display: flex;
            align-items: center; justify-content: center; transition: all 0.3s ease;
            text-decoration: none;
        }
        .whatsapp-float:hover { background-color: #128c7e; color: #fff; transform: scale(1.1); }

        /* Footer */
        .footer {
            background-color: var(--secondary-color); color: #fff;
            padding: 50px 0 20px; margin-top: 80px;
        }
        .footer h5 { color: var(--primary-color); margin-bottom: 20px; }
        .footer a { color: #ccc; text-decoration: none; transition: color 0.3s ease; }
        .footer a:hover { color: var(--primary-color); }
        .social-links a {
            display: inline-block; width: 40px; height: 40px;
            background-color: var(--primary-color); color: var(--secondary-color);
            text-align: center; line-height: 40px; border-radius: 50%;
            margin-right: 10px; transition: all 0.3s ease;
        }
        .social-links a:hover { background-color: var(--accent-color); transform: translateY(-3px); }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.5rem; }
            .search-form { margin: 20px; padding: 20px; }
            .whatsapp-float { width: 50px; height: 50px; bottom: 20px; right: 20px; font-size: 24px; }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- ===== Top Bar: só Instagram ===== -->
    <div class="header-top">
        <div class="container">
            <div class="ig-wrap">
                <a class="ig-pill" href="https://www.instagram.com/umuprimeimoveis" target="_blank" aria-label="Abrir Instagram UmuPrime Imóveis">
                    <i class="fab fa-instagram"></i>
                    <span>@umuprimeimoveis</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="UmuPrime Imóveis">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('sobre') }}">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('imoveis.aluguel') }}">Imóveis para Alugar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('imoveis.venda') }}">Imóveis à Venda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contato') }}">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/5544997292225?text=Olá! Gostaria de mais informações sobre os imóveis." class="whatsapp-float" target="_blank" aria-label="Conversar no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>UmuPrime Imóveis</h5>
                    <p>Sua imobiliária de confiança em Umuarama. Encontre o imóvel dos seus sonhos conosco.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/umuprimeimoveis" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/umuprime" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="https://wa.me/5544997292225" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Início</a></li>
                        <li><a href="{{ route('sobre') }}">Sobre</a></li>
                        <li><a href="{{ route('imoveis.aluguel') }}">Imóveis para Alugar</a></li>
                        <li><a href="{{ route('imoveis.venda') }}">Imóveis à Venda</a></li>
                        <li><a href="{{ route('contato') }}">Contato</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p><i class="fas fa-map-marker-alt"></i> Umuarama - PR</p>
                    <p><i class="fas fa-phone"></i> (44) 99729-2225</p>
                    <p><i class="fas fa-envelope"></i> contato@umuprime.com.br</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; {{ date('Y') }} UmuPrime Imóveis. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
