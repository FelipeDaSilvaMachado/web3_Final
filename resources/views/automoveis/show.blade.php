@extends('layouts.app')

@section('title', 'Detalhes do Automóvel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-eye me-2"></i>Detalhes do Automóvel
                        </h4>
                        <span class="badge bg-light text-primary fs-6">ID: {{ $id }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div id="detalhes-carregando" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-3">Carregando detalhes do automóvel...</p>
                    </div>

                    <div id="detalhes-conteudo" style="display: none;">
                        <!-- Conteúdo será carregado via JavaScript -->
                    </div>

                    <div id="detalhes-erro" class="text-center py-5" style="display: none;">
                        <i class="bi bi-exclamation-triangle display-4 text-danger"></i>
                        <h4 class="mt-3">Automóvel não encontrado</h4>
                        <p class="text-muted">O automóvel solicitado não existe ou foi removido.</p>
                        <a href="/automoveis" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Voltar para Lista
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="/automoveis" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Voltar para Lista
                        </a>
                        <div class="btn-group">
                            <button class="btn btn-outline-warning" onclick="editarAutomovel()" id="btn-editar">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </button>
                            <button class="btn btn-outline-danger" onclick="confirmarExclusao()" id="btn-excluir">
                                <i class="bi bi-trash me-1"></i>Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // let automovelId = {{ $id }};
    let automovelData = null;

    // Carregar detalhes quando a página carregar
    document.addEventListener('DOMContentLoaded', carregarDetalhes);

    function carregarDetalhes() {
        fetch('/api/automoveis/' + automovelId)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Automóvel não encontrado');
                }
                return response.json();
            })
            .then(function(data) {
                automovelData = data;
                exibirDetalhes(data);
            })
            .catch(function(error) {
                document.getElementById('detalhes-carregando').style.display = 'none';
                document.getElementById('detalhes-erro').style.display = 'block';
                document.getElementById('btn-editar').style.display = 'none';
                document.getElementById('btn-excluir').style.display = 'none';
            });
    }

    function exibirDetalhes(data) {
        const conteudo = document.getElementById('detalhes-conteudo');

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

        const corHex = cores[data.cor] || '#6c757d';

        let html = '<div class="row">';
        html += '<div class="col-md-8">';
        html += '<div class="row mb-4">';
        html += '<div class="col-md-6">';
        html += '<h5 class="text-primary">';
        html += '<i class="bi bi-card-text me-2"></i>Informações Básicas';
        html += '</h5>';
        html += '<table class="table table-sm">';
        html += '<tr>';
        html += '<th width="120">Nome:</th>';
        html += '<td><strong>' + (data.nome || 'Não informado') + '</strong></td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>Marca:</th>';
        html += '<td>' + data.marca + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>Modelo:</th>';
        html += '<td>' + data.modelo + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>Ano:</th>';
        html += '<td><span class="badge bg-secondary">' + data.ano + '</span></td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>Cor:</th>';
        html += '<td>';
        html += '<span class="badge" style="background-color: ' + corHex + '; color: white">';
        html += data.cor;
        html += '</span>';
        html += '</td>';
        html += '</tr>';
        html += '</table>';
        html += '</div>';

        html += '<div class="col-md-6">';
        html += '<h5 class="text-primary">';
        html += '<i class="bi bi-clock me-2"></i>Informações do Sistema';
        html += '</h5>';
        html += '<table class="table table-sm">';
        html += '<tr>';
        html += '<th width="120">Cadastrado em:</th>';
        html += '<td>' + new Date(data.created_at).toLocaleString('pt-BR') + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>Última atualização:</th>';
        html += '<td>' + new Date(data.updated_at).toLocaleString('pt-BR') + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<th>ID no sistema:</th>';
        html += '<td><code>' + data.id + '</code></td>';
        html += '</tr>';
        html += '</table>';
        html += '</div>';
        html += '</div>';

        if (data.descricao) {
            html += '<div class="mb-4">';
            html += '<h5 class="text-primary">';
            html += '<i class="bi bi-text-paragraph me-2"></i>Descrição';
            html += '</h5>';
            html += '<div class="card">';
            html += '<div class="card-body">';
            html += '<p class="mb-0">' + data.descricao + '</p>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }

        html += '</div>';

        html += '<div class="col-md-4">';
        html += '<div class="card">';
        html += '<div class="card-body text-center">';
        html += '<i class="bi bi-car-front display-1 text-primary mb-3"></i>';
        html += '<h5>' + data.marca + ' ' + data.modelo + '</h5>';
        html += '<p class="text-muted">' + data.ano + '</p>';

        html += '<div class="mt-4">';
        html += '<button class="btn btn-outline-primary w-100 mb-2" onclick="testarEndpoint(\'GET\', \'/api/automoveis/' + data.id + '\')">';
        html += '<i class="bi bi-code me-1"></i>Ver JSON da API';
        html += '</button>';

        html += '<button class="btn btn-outline-success w-100" onclick="copiarParaAreaTransferencia()">';
        html += '<i class="bi bi-clipboard me-1"></i>Copiar Dados';
        html += '</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        html += '<div class="card mt-3">';
        html += '<div class="card-body">';
        html += '<h6 class="card-title">';
        html += '<i class="bi bi-share me-2"></i>Endpoints da API';
        html += '</h6>';
        html += '<div class="mb-2">';
        html += '<small><strong>GET:</strong> <code>/api/automoveis/' + data.id + '</code></small>';
        html += '</div>';
        html += '<div class="mb-2">';
        html += '<small><strong>PUT/PATCH:</strong> <code>/api/automoveis/' + data.id + '</code></small>';
        html += '</div>';
        html += '<div>';
        html += '<small><strong>DELETE:</strong> <code>/api/automoveis/' + data.id + '</code></small>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        html += '<div id="resultado-api" class="mt-3"></div>';

        conteudo.innerHTML = html;
        document.getElementById('detalhes-carregando').style.display = 'none';
        conteudo.style.display = 'block';
    }

    function editarAutomovel() {
        if (automovelData) {
            // Implementar edição (pode ser um modal ou página separada)
            mostrarNotificacao('Editando automóvel: ' + (automovelData.nome || automovelData.marca), 'info');
            // window.location.href = '/automoveis/' + automovelId + '/edit'; // Se tiver rota de edição
        }
    }

    function confirmarExclusao() {
        if (automovelData && confirm('Tem certeza que deseja excluir o automóvel "' + (automovelData.nome || automovelData.marca) + '"? Esta ação não pode ser desfeita.')) {
            excluirAutomovel();
        }
    }

    function excluirAutomovel() {
        fetch('/api/automoveis/' + automovelId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : ''
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                mostrarNotificacao('Automóvel excluído com sucesso!', 'success');
                setTimeout(function() {
                    window.location.href = '/automoveis';
                }, 1500);
            })
            .catch(function(error) {
                mostrarNotificacao('Erro ao excluir automóvel: ' + error.message, 'danger');
            });
    }

    function testarEndpoint(metodo, endpoint) {
        fetch(endpoint)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                const resultado = document.getElementById('resultado-api');
                resultado.innerHTML = '<div class="alert alert-info">' +
                    '<h6><i class="bi bi-code-slash me-2"></i>Resposta da API</h6>' +
                    '<pre class="bg-dark text-light p-3 rounded mt-2">' + JSON.stringify(data, null, 2) + '</pre>' +
                    '</div>';
            });
    }

    function copiarParaAreaTransferencia() {
        // Verifica se os dados do automóvel foram carregados
        if (!automovelData) {
            mostrarNotificacao('Erro: Dados do automóvel não carregados', 'danger');
            return;
        }

        // Constrói o texto manualmente (sem template strings)
        const texto = 'Automóvel: ' + automovelData.marca + ' ' + automovelData.modelo + '\n' +
            'ID: ' + automovelData.id + '\n' +
            'Nome: ' + (automovelData.nome || 'Não informado') + '\n' +
            'Ano: ' + automovelData.ano + '\n' +
            'Cor: ' + automovelData.cor + '\n' +
            'Descrição: ' + (automovelData.descricao || 'Não informada') + '\n' +
            'Cadastrado em: ' + new Date(automovelData.created_at).toLocaleDateString('pt-BR');

        // Tenta copiar para a área de transferência
        if (navigator.clipboard && window.isSecureContext) {
            // Método moderno (requer HTTPS ou localhost)
            navigator.clipboard.writeText(texto)
                .then(function() {
                    mostrarNotificacao('Dados copiados para a área de transferência!', 'success');
                })
                .catch(function(err) {
                    // Fallback para método antigo
                    usarMetodoAntigo(texto);
                });
        } else {
            // Método antigo para navegadores mais velhos
            usarMetodoAntigo(texto);
        }
    }

    // Fallback para navegadores que não suportam clipboard API
    function usarMetodoAntigo(texto) {
        const textarea = document.createElement('textarea');
        textarea.value = texto;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();

        try {
            const success = document.execCommand('copy');
            document.body.removeChild(textarea);

            if (success) {
                mostrarNotificacao('Dados copiados para a área de transferência!', 'success');
            } else {
                mostrarNotificacao('Erro ao copiar dados. Tente manualmente.', 'danger');
            }
        } catch (err) {
            document.body.removeChild(textarea);
            mostrarNotificacao('Erro ao copiar dados: ' + err.message, 'danger');
        }
    }

    // Função para mostrar notificações
    function mostrarNotificacao(mensagem, tipo) {
        const alerta = document.createElement('div');
        alerta.className = 'alert alert-' + tipo + ' alert-dismissible fade show';
        alerta.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);';

        let icone = 'bi-info-circle';
        if (tipo === 'success') icone = 'bi-check-circle';
        if (tipo === 'danger') icone = 'bi-exclamation-triangle';
        if (tipo === 'warning') icone = 'bi-exclamation-circle';

        alerta.innerHTML = '<i class="bi ' + icone + ' me-2"></i>' +
            mensagem +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

        document.body.appendChild(alerta);

        setTimeout(function() {
            if (alerta.parentNode) {
                alerta.remove();
            }
        }, 5000);
    }

    // Teste de inicialização
    console.log('Página de detalhes carregada para o automóvel ID:', automovelId);
</script>
@endsection
