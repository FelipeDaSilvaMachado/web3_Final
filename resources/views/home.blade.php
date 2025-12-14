@extends('layouts.app')

@section('title', 'Início')

@section('content')
<div class="text-center py-5">
    <h1 class="display-4 fw-bold text-primary mb-4">
        <i class="bi bi-car-front-fill"></i> Sistema de Automóveis
    </h1>

    <p class="lead mb-5">API Laravel para gerenciamento completo de frota de veículos</p>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-database display-4 text-primary mb-3"></i>
                                    <h5>CRUD Completo</h5>
                                    <p class="text-muted">Cadastro, listagem, edição e exclusão</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-arrow-left-right display-4 text-success mb-3"></i>
                                    <h5>API RESTful</h5>
                                    <p class="text-muted">Endpoints JSON para integração</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-shield-check display-4 text-warning mb-3"></i>
                                    <h5>Validação</h5>
                                    <p class="text-muted">Validação robusta de dados</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-3 col-md-8 mx-auto mt-4">
                        <a href="/automoveis" class="btn btn-primary btn-lg">
                            <i class="bi bi-list-ul me-2"></i> Ver Todos os Automóveis
                        </a>

                        <a href="/automoveis/create" class="btn btn-success btn-lg">
                            <i class="bi bi-plus-circle me-2"></i> Cadastrar Novo Automóvel
                        </a>

                        <button onclick="testarAPI()" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-lightning-charge me-2"></i> Testar API REST
                        </button>
                    </div>

                    <div id="resultado-api" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testarAPI() {
    const btn = event.target;
    const originalText = btn.innerHTML;

    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Testando API...';
    btn.disabled = true;

    fetch('/api/automoveis')
        .then(response => response.json())
        .then(data => {
            const resultado = document.getElementById('resultado-api');
            resultado.innerHTML = `
                <div class="alert alert-success mt-3">
                    <h5><i class="bi bi-check-circle"></i> API Funcionando!</h5>
                    <p>Foram encontrados <strong>${data.length}</strong> automóveis no banco de dados.</p>
                    <button class="btn btn-sm btn-outline-success" onclick="verDetalhesAPI()">
                        Ver Detalhes da API
                    </button>
                    <div id="detalhes-api" class="mt-2"></div>
                </div>
            `;
        })
        .catch(error => {
            document.getElementById('resultado-api').innerHTML = `
                <div class="alert alert-danger mt-3">
                    <h5><i class="bi bi-exclamation-triangle"></i> Erro na API</h5>
                    <p>${error.message}</p>
                </div>
            `;
        })
        .finally(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
}

function verDetalhesAPI() {
    fetch('/api/automoveis')
        .then(response => response.json())
        .then(data => {
            const detalhes = document.getElementById('detalhes-api');
            let html = '<div class="mt-3"><h6>Dados da API:</h6>';
            html += '<pre class="bg-dark text-light p-3 rounded" style="font-size: 0.8rem;">';
            html += JSON.stringify(data, null, 2);
            html += '</pre></div>';
            detalhes.innerHTML = html;
        });
}
</script>
@endsection
