// Importar Bootstrap
import * as bootstrap from 'bootstrap';

// Importar Bootstrap Icons
import 'bootstrap-icons/font/bootstrap-icons.css';

// Seu JavaScript personalizado
document.addEventListener('DOMContentLoaded', function() {
    console.log('API de Automóveis - Sistema carregado');

    // Inicializar tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Inicializar popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    // Exemplo: Botão para carregar automóveis
    const btnCarregar = document.getElementById('btn-carregar-automoveis');
    if (btnCarregar) {
        btnCarregar.addEventListener('click', carregarAutomoveis);
    }

    // Exemplo: Formulário de cadastro
    const formCadastro = document.getElementById('form-cadastro-automovel');
    if (formCadastro) {
        formCadastro.addEventListener('submit', validarFormulario);
    }
});

// Função para carregar automóveis da API
async function carregarAutomoveis() {
    const btn = document.getElementById('btn-carregar-automoveis');
    const originalText = btn.innerHTML;

    // Mostrar loading
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Carregando...';
    btn.disabled = true;

    try {
        const response = await fetch('/api/automoveis');
        if (!response.ok) throw new Error('Erro na resposta da API');

        const automoveis = await response.json();
        exibirAutomoveis(automoveis);

        // Mostrar notificação de sucesso
        mostrarNotificacao('Automóveis carregados com sucesso!', 'success');

    } catch (error) {
        console.error('Erro ao carregar automóveis:', error);
        mostrarNotificacao('Erro ao carregar automóveis. Tente novamente.', 'danger');

    } finally {
        // Restaurar botão
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
}

// Função para exibir automóveis na página
function exibirAutomoveis(automoveis) {
    const container = document.getElementById('lista-automoveis');
    if (!container) return;

    if (automoveis.length === 0) {
        container.innerHTML = `
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Nenhum automóvel cadastrado.
            </div>
        `;
        return;
    }

    let html = `
        <div class="table-responsive">
            <table class="table table-hover table-automoveis">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Cor</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
    `;

    automoveis.forEach(auto => {
        html += `
            <tr>
                <td>${auto.id}</td>
                <td><strong>${auto.marca}</strong></td>
                <td>${auto.modelo}</td>
                <td><span class="badge bg-secondary">${auto.ano}</span></td>
                <td>
                    <span class="badge" style="background-color: ${auto.cor?.toLowerCase() || '#6c757d'}; color: white">
                        ${auto.cor || 'N/A'}
                    </span>
                </td>
                <td>R$ ${auto.preco?.toLocaleString('pt-BR', { minimumFractionDigits: 2 }) || '0,00'}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="verDetalhes(${auto.id})">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-success" onclick="editarAutomovel(${auto.id})">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    html += `
                </tbody>
            </table>
        </div>
        <p class="text-muted">Total: ${automoveis.length} automóveis</p>
    `;

    container.innerHTML = html;
}

// Função para mostrar notificações
function mostrarNotificacao(mensagem, tipo = 'info') {
    // Remove notificações anteriores
    const notificacoesAntigas = document.querySelectorAll('.notificacao-custom');
    notificacoesAntigas.forEach(n => n.remove());

    // Cria nova notificação
    const notificacao = document.createElement('div');
    notificacao.className = `alert alert-${tipo} alert-dismissible fade show notificacao-custom`;
    notificacao.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    `;

    const icones = {
        'success': 'bi-check-circle',
        'danger': 'bi-exclamation-circle',
        'warning': 'bi-exclamation-triangle',
        'info': 'bi-info-circle'
    };

    notificacao.innerHTML = `
        <i class="bi ${icones[tipo] || 'bi-info-circle'} me-2"></i>
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notificacao);

    // Remove automaticamente após 5 segundos
    setTimeout(() => {
        if (notificacao.parentNode) {
            notificacao.remove();
        }
    }, 5000);
}

// Função para validar formulário
function validarFormulario(event) {
    event.preventDefault();

    const form = event.target;
    const marca = form.querySelector('#marca').value;
    const modelo = form.querySelector('#modelo').value;

    if (!marca || !modelo) {
        mostrarNotificacao('Preencha todos os campos obrigatórios.', 'warning');
        return;
    }

    // Aqui você faria o submit para a API
    mostrarNotificacao('Automóvel cadastrado com sucesso!', 'success');
    form.reset();
}

// Funções globais (para usar em onclick)
window.verDetalhes = function(id) {
    mostrarNotificacao(`Visualizando automóvel ID: ${id}`, 'info');
    // Aqui você pode redirecionar para página de detalhes
};

window.editarAutomovel = function(id) {
    mostrarNotificacao(`Editando automóvel ID: ${id}`, 'warning');
    // Aqui você pode abrir modal de edição
};
