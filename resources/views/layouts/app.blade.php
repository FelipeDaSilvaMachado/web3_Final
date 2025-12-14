<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistema de Automóveis</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .table th {
            background-color: #1e3a8a;
            color: white;
        }
        .btn-primary {
            background: linear-gradient(45deg, #1e3a8a, #3b82f6);
            border: none;
        }
        .btn-success {
            background: linear-gradient(45deg, #059669, #10b981);
            border: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-car-front me-2"></i>
                Sistema de Automóveis
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi bi-house"></i> Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/automoveis">
                            <i class="bi bi-list-ul"></i> Automóveis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/automoveis/create">
                            <i class="bi bi-plus-circle"></i> Cadastrar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/documentacao">
                            <i class="bi bi-code-slash"></i> API Docs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sobre">
                            <i class="bi bi-info-circle"></i> Sobre
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">
                        <i class="bi bi-car-front"></i> Sistema de Automóveis
                    </h5>
                    <p>API RESTful desenvolvida com Laravel</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <strong>ETEC</strong> - Terceiro Semestre<br>
                        Web III - Laravel API
                    </p>
                </div>
            </div>
            <hr class="bg-light my-3">
            <div class="text-center">
                <p class="mb-0">© {{ date('Y') }} - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts Globais -->
    <script>
        // Função para mostrar notificações
        function mostrarNotificacao(mensagem, tipo = 'info') {
            const alerta = document.createElement('div');
            alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
            alerta.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';

            const icones = {
                'success': 'bi-check-circle',
                'danger': 'bi-exclamation-triangle',
                'warning': 'bi-exclamation-circle',
                'info': 'bi-info-circle'
            };

            alerta.innerHTML = `
                <i class="bi ${icones[tipo] || 'bi-info-circle'} me-2"></i>
                ${mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(alerta);

            setTimeout(() => {
                if (alerta.parentNode) {
                    alerta.remove();
                }
            }, 5000);
        }
    </script>

    @stack('scripts')
</body>
</html>
