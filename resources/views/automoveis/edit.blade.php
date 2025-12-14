@extends('layouts.app')

@section('title', 'Alterar Automóvel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Alterar Automóvel
                    </h4>
                </div>
                <div class="card-body">
                    <form id="form-editar" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">
                                    <i class="bi bi-card-text text-primary me-1"></i>Nome do Veículo *
                                </label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="marca" class="form-label">
                                    <i class="bi bi-building text-primary me-1"></i>Marca *
                                </label>
                                <input type="text" class="form-control" id="marca" name="marca" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="modelo" class="form-label">
                                    <i class="bi bi-car-front text-primary me-1"></i>Modelo *
                                </label>
                                <select class="form-select" id="modelo" name="modelo" required>
                                    <option value="">Selecione...</option>
                                    <option value="Hatch">Hatch</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Esportivo">Esportivo</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ano" class="form-label">
                                    <i class="bi bi-calendar text-primary me-1"></i>Ano *
                                </label>
                                <input type="text" class="form-control" id="ano" name="ano"
                                    required maxlength="4">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cor" class="form-label">
                                    <i class="bi bi-palette text-primary me-1"></i>Cor *
                                </label>
                                <select class="form-select" id="cor" name="cor" required>
                                    <option value="">Selecione...</option>
                                    <option value="Preto">Preto</option>
                                    <option value="Branco">Branco</option>
                                    <option value="Prata">Prata</option>
                                    <option value="Cinza">Cinza</option>
                                    <option value="Vermelho">Vermelho</option>
                                    <option value="Azul">Azul</option>
                                    <option value="Verde">Verde</option>
                                    <option value="Amarelo">Amarelo</option>
                                    <option value="Marrom">Marrom</option>
                                    <option value="Laranja">Laranja</option>
                                    <option value="Outra">Outra</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">
                                <i class="bi bi-text-paragraph text-primary me-1"></i>Descrição
                            </label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="5">
                            </textarea>
                            <div class="form-text">Informações extras sobre o automóvel</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="/automoveis" class="btn btn-secondary me-md-2">
                                <i class="bi bi-x-circle me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i>Salvar Automóvel
                            </button>
                        </div>
                    </form>

                    <div id="resultado-editar" class="mt-3"></div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-info-circle text-info me-2"></i>Informações Importantes
                    </h5>
                    <ul class="mb-0">
                        <li>Campos marcados com * são obrigatórios</li>
                        <li>Os dados serão validados pelo servidor antes do cadastro</li>
                        <li>Após cadastrar, você será redirecionado para a lista de automóveis</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let automovelId = 0;
    // // No início do seu script
    // const automovelId = document.getElementById('automovelId')?.value || 0;
    // CARREGAR DADOS DO AUTOMÓVEL QUANDO A PÁGINA ABRIR
    document.addEventListener('DOMContentLoaded', function() {
        // Pegar o ID da URL
        const caminho = window.location.pathname; // ex: "/automoveis/1/update"
        const partes = caminho.split('/');
        const id = partes[2] || 0; // Pega o ID (terceira parte)

        console.log('ID detectado:', automovelId);


        if (id && !isNaN(id)) {
            carregarDadosAutomovel(id);
        } else {
            mostrarErro('ID do automóvel não encontrado na URL');
        }
    });

    function carregarDadosAutomovel(id) {
        console.log('Buscando dados para ID:', id);
        fetch(`/api/automoveis/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Automóvel não encontrado');
                }
                return response.json();
            })
            .then(data => {
                // PREENCHER OS CAMPOS DO FORMULÁRIO
                document.getElementById('nome').value = data.nome || '';
                document.getElementById('marca').value = data.marca || '';
                document.getElementById('modelo').value = data.modelo || '';
                document.getElementById('ano').value = data.ano || '';
                document.getElementById('cor').value = data.cor || '';
                document.getElementById('descricao').value = data.descricao || '';

                // ATUALIZAR A ACTION DO FORMULÁRIO COM O ID CORRETO
                // ATUALIZAR ACTION CORRETAMENTE (sem /edit)
                document.getElementById('form-editar').action = `/api/automoveis/${data.id}`;
                console.log('Action do formulário:', document.getElementById('form-editar').action);

                // Atualizar título da página (opcional)
                document.title = `Editar: ${data.marca} ${data.modelo}`;
            })
            .catch(error => {
                mostrarErro(`Erro ao carregar dados: ${error.message}`);
            });
    }

    function mostrarErro(mensagem) {
        const resultado = document.getElementById('resultado-editar');
        resultado.innerHTML = `
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> ${mensagem}
            <div class="mt-2">
                <a href="/automoveis" class="btn btn-sm btn-outline-secondary">
                    Voltar para lista
                </a>
            </div>
        </div>
    `;

        // Desabilitar o formulário
        document.getElementById('form-editar').querySelectorAll('input, select, textarea, button')
            .forEach(element => {
                element.disabled = true;
            });
    }
    document.addEventListener('DOMContentLoaded', function() {
        if (automovelId > 0) {
            fetch(`/api/automoveis/${automovelId}`)
                .then(response => response.json())
                .then(data => {
                    // Preencher os campos com os dados existentes
                    document.getElementById('nome').value = data.nome || '';
                    document.getElementById('marca').value = data.marca || '';
                    document.getElementById('modelo').value = data.modelo || '';
                    document.getElementById('ano').value = data.ano || '';
                    document.getElementById('cor').value = data.cor || '';
                    document.getElementById('descricao').value = data.descricao || '';

                    // Atualizar a action do formulário com o ID correto
                    document.getElementById('form-editar').action = `/api/automoveis/${data.id}/edit`;
                })
                .catch(error => {
                    console.error('Erro ao carregar automóvel:', error);
                    mostrarErro('Não foi possível carregar os dados do automóvel.');
                });
        }
    });
    // SUBMIT DO FORMULÁRIO
    document.getElementById('form-editar').addEventListener('submit', function(event) {
        event.preventDefault();

        console.log('=== SUBMIT INICIADO ===');

        const form = event.target;
        const resultado = document.getElementById('resultado-editar');
        const btnSubmit = form.querySelector('button[type="submit"]');

        console.log('Action:', form.action);
        console.log('Resultado elemento:', resultado);

        if (!resultado) {
            console.error('Erro: #resultado-editar não existe');
            return;
        }

        const originalText = btnSubmit.innerHTML;

        // Loading
        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Salvando...';
        btnSubmit.disabled = true;

        // Coletar dados
        const formData = new FormData(form);
        const dados = Object.fromEntries(formData.entries());
        console.log('Dados enviados:', dados);

        // Enviar para API
        fetch(form.action, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(dados)
            })
            .then(response => {
                console.log('Status HTTP:', response.status);
                return response.json().then(data => ({
                    status: response.status,
                    body: data
                }));
            })
            .then(({
                status,
                body
            }) => {
                console.log('Resposta API:', {
                    status,
                    body
                });

                if (status === 200 || status === 201) {
                    // SUCESSO
                    resultado.innerHTML = `
                    <div class="alert alert-success">
                        <h5><i class="bi bi-check-circle"></i> Automóvel atualizado com sucesso!</h5>
                        <p><strong>ID:</strong> ${body.id}</p>
                        <p><strong>Nome:</strong> ${body.nome}</p>
                        <p><strong>Marca/Modelo:</strong> ${body.marca} ${body.modelo}</p>
                        <p class="mb-0">Redirecionando para a lista em 3 segundos...</p>
                    </div>
                `;

                    // Redirecionar
                    setTimeout(() => {
                        window.location.href = '/automoveis';
                    }, 3000);

                } else if (status === 422) {
                    // ERRO VALIDAÇÃO
                    let erros = '<ul class="mb-0">';
                    for (const campo in body.errors) {
                        body.errors[campo].forEach(erro => {
                            erros += `<li><strong>${campo}:</strong> ${erro}</li>`;
                        });
                    }
                    erros += '</ul>';

                    resultado.innerHTML = `
                    <div class="alert alert-danger">
                        <h5><i class="bi bi-exclamation-triangle"></i> Erro de validação</h5>
                        ${erros}
                    </div>
                `;

                } else {
                    // OUTRO ERRO
                    resultado.innerHTML = `
                    <div class="alert alert-danger">
                        <h5><i class="bi bi-exclamation-triangle"></i> Erro ${status}</h5>
                        <p>${body.message || 'Erro ao atualizar automóvel'}</p>
                    </div>
                `;
                }
            })
            .catch(error => {
                console.error('Erro fetch:', error);
                resultado.innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> Erro de conexão</h5>
                    <p>${error.message}</p>
                </div>
            `;
            })
            .finally(() => {
                btnSubmit.innerHTML = originalText;
                btnSubmit.disabled = false;
                console.log('=== SUBMIT FINALIZADO ===');
            });
    });
</script>
@endsection
