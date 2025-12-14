@extends('layouts.app')

@section('title', 'Documentação da API')

@section('content')
<div class="container">
    <h1 class="display-5 fw-bold mb-4">
        <i class="bi bi-code-slash text-primary"></i> Documentação da API
    </h1>

    <div class="row">
        <div class="col-lg-8">
            <!-- Lista todos os automóveis -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">GET /api/automoveis</h5>
                </div>
                <div class="card-body">
                    <p>Retorna todos os automóveis cadastrados no sistema.</p>

                    <h6>Exemplo de Resposta:</h6>
                    <pre class="bg-dark text-light p-3 rounded"><code>[
  {
    "id": 1,
    "nome": "Meu Carro",
    "marca": "Toyota",
    "modelo": "Corolla",
    "ano": "2024",
    "cor": "Prata",
    "descricao": "Carro em perfeito estado",
    "created_at": "2024-12-14T10:00:00.000000Z",
    "updated_at": "2024-12-14T10:00:00.000000Z"
  }
]</code></pre>

                    <button class="btn btn-sm btn-success" onclick="testarEndpoint('GET', '/api/automoveis')">
                        <i class="bi bi-play me-1"></i>Testar Endpoint
                    </button>
                </div>
            </div>

            <!-- Cadastrar automóvel -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">POST /api/automoveis</h5>
                </div>
                <div class="card-body">
                    <p>Cadastra um novo automóvel no sistema.</p>

                    <h6>Parâmetros (JSON):</h6>
                    <pre class="bg-dark text-light p-3 rounded"><code>{
  "nome": "string (obrigatório)",
  "marca": "string (obrigatório)",
  "modelo": "string (obrigatório)",
  "ano": "string (obrigatório)",
  "cor": "string (obrigatório)",
  "descricao": "string (opcional)"
}</code></pre>

                    <div class="mt-3">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTestePOST">
                            <i class="bi bi-play me-1"></i>Testar com Dados de Exemplo
                        </button>
                    </div>
                </div>
            </div>

            <!-- Ver um automóvel específico -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">GET /api/automoveis/{id}</h5>
                </div>
                <div class="card-body">
                    <p>Retorna um automóvel específico pelo ID.</p>

                    <div class="input-group mb-3" style="max-width: 300px;">
                        <span class="input-group-text">ID:</span>
                        <input type="number" id="idAutomovel" class="form-control" placeholder="1" value="1" min="1">
                        <button class="btn btn-info" onclick="testarEndpoint('GET', '/api/automoveis/' + document.getElementById('idAutomovel').value)">
                            <i class="bi bi-play me-1"></i>Testar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Atualizar automóvel -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">PUT/PATCH /api/automoveis/{id}</h5>
                </div>
                <div class="card-body">
                    <p>Atualiza um automóvel existente. Use <code>PUT</code> para atualização completa ou <code>PATCH</code> para atualização parcial.</p>
                </div>
            </div>

            <!-- Excluir automóvel -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">DELETE /api/automoveis/{id}</h5>
                </div>
                <div class="card-body">
                    <p>Remove um automóvel do sistema.</p>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Atenção:</strong> Esta ação é irreversível.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>Teste Rápido
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Selecione um Endpoint:</label>
                        <select class="form-select" id="select-endpoint" onchange="atualizarEndpointTeste()">
                            <option value="/api/automoveis">GET /api/automoveis</option>
                            <option value="/api/automoveis/1">GET /api/automoveis/{id}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Método HTTP:</label>
                        <select class="form-select" id="select-metodo">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="PATCH">PATCH</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </div>

                    <div class="mb-3" id="div-body" style="display: none;">
                        <label class="form-label">Body (JSON):</label>
                        <textarea class="form-control" id="input-body" rows="5" placeholder='{"nome": "Exemplo", "marca": "Teste", ...}'></textarea>
                    </div>

                    <button class="btn btn-primary w-100" onclick="executarTesteManual()">
                        <i class="bi bi-play-circle me-1"></i>Executar Teste
                    </button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-tools me-2"></i>Ferramentas Úteis
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://www.postman.com/" target="_blank" class="text-decoration-none">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Postman
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://insomnia.rest/" target="_blank" class="text-decoration-none">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Insomnia
                            </a>
                        </li>
                        <li>
                            <a href="https://curl.se/" target="_blank" class="text-decoration-none">
                                <i class="bi bi-box-arrow-up-right me-2"></i>CURL
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="resultado-teste" class="mt-4"></div>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Voltar para Início
        </a>
        <a href="/automoveis" class="btn btn-primary">
            <i class="bi bi-list-ul me-1"></i>Ver Interface Web
        </a>
    </div>
</div>

<!-- Modal para teste POST -->
<div class="modal fade" id="modalTestePOST" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Testar POST /api/automoveis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Use este exemplo para testar o cadastro:</p>
                <pre class="bg-dark text-light p-3 rounded">
                    <code>{
                            "nome": "Carro de Teste",
                            "marca": "Toyota",
                            "modelo": "Corolla",
                            "ano": "2024",
                            "cor": "Prata",
                            "descricao": "Carro de teste para a API"
                       }
                    </code>
                </pre>
            </div>

            <button class="btn btn-primary w-100" onclick="testarCadastroExemplo()">
                <i class="bi bi-send me-1"></i>Enviar Dados de Teste
            </button>
        </div>
    </div>
</div>
</div>

<script>
    function testarEndpoint(metodo, endpoint) {
        const resultado = document.getElementById('resultado-teste');
        resultado.innerHTML = '<div class="alert alert-info">Testando...</div>';

        const opcoes = {
            method: metodo,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        };

        fetch(endpoint, opcoes)
            .then(response => response.json().then(data => ({
                status: response.status,
                body: data
            })))
            .then(({
                status,
                body
            }) => {
                let classe = 'success';
                if (status >= 400) classe = 'danger';

                resultado.innerHTML = `
                <div class="alert alert-${classe}">
                    <h5><i class="bi bi-${classe === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i> Resposta (${status})</h5>
                    <p><strong>Endpoint:</strong> <code>${metodo} ${endpoint}</code></p>
                    <pre class="bg-dark text-light p-3 rounded mt-2">${JSON.stringify(body, null, 2)}</pre>
                </div>
            `;
            })
            .catch(error => {
                resultado.innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> Erro</h5>
                    <p>${error.message}</p>
                </div>
            `;
            });
    }

    function testarCadastroExemplo() {
        const dados = {
            nome: "Carro de Teste API",
            marca: "Toyota",
            modelo: "Corolla",
            ano: "2024",
            cor: "Prata",
            descricao: "Carro cadastrado via teste da API"
        };

        fetch('/api/automoveis', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(dados)
            })
            .then(response => response.json().then(data => ({
                status: response.status,
                body: data
            })))
            .then(({
                status,
                body
            }) => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalTestePOST'));
                modal.hide();

                const resultado = document.getElementById('resultado-teste');
                if (status === 201) {
                    resultado.innerHTML = `
                <div class="alert alert-success">
                    <h5><i class="bi bi-check-circle"></i> Cadastro realizado com sucesso!</h5>
                    <p><strong>ID:</strong> ${body.id}</p>
                    <pre class="bg-dark text-light p-3 rounded mt-2">${JSON.stringify(body, null, 2)}</pre>
                    <a href="/automoveis/${body.id}" class="btn btn-sm btn-success mt-2">
                        <i class="bi bi-eye"></i> Ver Detalhes
                    </a>
                </div>
            `;
                } else {
                    resultado.innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> Erro (${status})</h5>
                    <pre class="bg-dark text-light p-3 rounded mt-2">${JSON.stringify(body, null, 2)}</pre>
                </div>
            `;
                }
            })
            .catch(error => {
                resultado.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="bi bi-exclamation-triangle"></i> Erro de conexão</h5>
                <p>${error.message}</p>
            </div>
        `;
            });
    }

    function atualizarEndpointTeste() {
        const endpoint = document.getElementById('select-endpoint').value;
        const metodo = document.getElementById('select-metodo').value;
        const divBody = document.getElementById('div-body');

        // Mostrar textarea para métodos que precisam de body
        if (metodo === 'POST' || metodo === 'PUT' || metodo === 'PATCH') {
            divBody.style.display = 'block';
        } else {
            divBody.style.display = 'none';
        }

        // Se for endpoint com {id}, adicionar campo para ID
        if (endpoint.includes('{id}')) {
            // Implementar lógica para substituir {id}
        }
    }

    function executarTesteManual() {
        const endpoint = document.getElementById('select-endpoint').value;
        const metodo = document.getElementById('select-metodo').value;
        const body = document.getElementById('input-body').value;

        const opcoes = {
            method: metodo,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || ''
            }
        };

        if (body && (metodo === 'POST' || metodo === 'PUT' || metodo === 'PATCH')) {
            try {
                opcoes.body = JSON.stringify(JSON.parse(body));
            } catch (e) {
                document.getElementById('resultado-teste').innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> JSON Inválido</h5>
                    <p>${e.message}</p>
                </div>
            `;
                return;
            }
        }

        testarEndpoint(metodo, endpoint);
    }

    // Inicializar
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('select-metodo').addEventListener('change', atualizarEndpointTeste);
    });
</script>
@endsection
