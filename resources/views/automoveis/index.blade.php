@extends('layouts.app')

@section('title', 'Lista de Automóveis')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold">
                <i class="bi bi-car-front text-primary"></i> Automóveis Cadastrados
            </h1>
            <p class="text-muted">Gerencie todos os veículos do sistema</p>
        </div>
        <a href="/automoveis/create" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Novo Automóvel
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-list-ul me-2"></i> Lista Completa
                <span class="badge bg-light text-primary ms-2" id="contador">0</span>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tabela-automoveis">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th>Cor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="corpo-tabela">
                        <!-- Dados serão carregados via JavaScript -->
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                                <p class="mt-2">Carregando automóveis...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="text-muted" id="info-contagem">Carregando...</span>
                </div>
                <div class="btn-group">
                    <button class="btn btn-outline-primary btn-sm" onclick="carregarAutomoveis()">
                        <i class="bi bi-arrow-clockwise"></i> Atualizar
                    </button>
                    <a href="/" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Carregar automóveis quando a página carregar
document.addEventListener('DOMContentLoaded', carregarAutomoveis);

function carregarAutomoveis() {
    const tabela = document.getElementById('corpo-tabela');
    tabela.innerHTML = `
        <tr>
            <td colspan="7" class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
                <p class="mt-2">Carregando automóveis...</p>
            </td>
        </tr>
    `;

    fetch('/api/automoveis')
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                tabela.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <h5 class="mt-3">Nenhum automóvel cadastrado</h5>
                            <p class="text-muted">Comece cadastrando seu primeiro automóvel!</p>
                            <a href="/automoveis/create" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Cadastrar Primeiro Automóvel
                            </a>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            data.forEach(auto => {
                html += `
                    <tr>
                        <td><strong>${auto.id}</strong></td>
                        <td>${auto.nome || 'Sem nome'}</td>
                        <td>${auto.marca}</td>
                        <td>${auto.modelo}</td>
                        <td><span class="badge bg-secondary">${auto.ano}</span></td>
                        <td>
                            <span class="badge" style="background-color: ${getCorHex(auto.cor)}; color: white">
                                ${auto.cor}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="verDetalhes(${auto.id})" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" onclick="editarAutomovel(${auto.id})" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger" onclick="confirmarExclusao(${auto.id}, '${auto.nome || auto.marca}')" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            tabela.innerHTML = html;
            document.getElementById('contador').textContent = data.length;
            document.getElementById('info-contagem').textContent = `Total: ${data.length} automóveis`;
        })
        .catch(error => {
            tabela.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-5 text-danger">
                        <i class="bi bi-exclamation-triangle display-4"></i>
                        <h5 class="mt-3">Erro ao carregar dados</h5>
                        <p>${error.message}</p>
                        <button class="btn btn-primary" onclick="carregarAutomoveis()">
                            <i class="bi bi-arrow-clockwise"></i> Tentar novamente
                        </button>
                    </td>
                </tr>
            `;
        });
}

function getCorHex(cor) {
    const cores = {
        'Preto': '#000000',
        'Branco': '#FFFFFF',
        'Prata': '#C0C0C0',
        'Cinza': '#808080',
        'Vermelho': '#FF0000',
        'Azul': '#0000FF',
        'Verde': '#008000',
        'Amarelo': '#FFFF00',
        'Marrom': '#A52A2A',
        'Laranja': '#FFA500'
    };
    return cores[cor] || '#6c757d';
}

function verDetalhes(id) {
    window.location.href = `/automoveis/${id}`;
}

function editarAutomovel(id) {
    // Implementar edição (modal ou página separada)
    mostrarNotificacao(`Editar automóvel ID: ${id}`, 'info');
}

function confirmarExclusao(id, nome) {
    if (confirm(`Tem certeza que deseja excluir o automóvel "${nome}" (ID: ${id})?`)) {
        excluirAutomovel(id);
    }
}

function excluirAutomovel(id) {
    fetch(`/api/automoveis/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        mostrarNotificacao('Automóvel excluído com sucesso!', 'success');
        carregarAutomoveis();
    })
    .catch(error => {
        mostrarNotificacao('Erro ao excluir automóvel: ' + error.message, 'danger');
    });
}
</script>
@endsection
