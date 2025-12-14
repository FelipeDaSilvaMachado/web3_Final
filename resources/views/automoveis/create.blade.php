@extends('layouts.app')

@section('title', 'Cadastrar Automóvel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Cadastrar Novo Automóvel
                    </h4>
                </div>
                <div class="card-body">
                    <form id="form-cadastro" method="POST" action="/api/automoveis">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">
                                    <i class="bi bi-card-text text-primary me-1"></i>Nome do Veículo *
                                </label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="XC60, T-Cross, Fusca" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="marca" class="form-label">
                                    <i class="bi bi-building text-primary me-1"></i>Marca *
                                </label>
                                <input type="text" class="form-control" id="marca" name="marca"
                                    placeholder="Ex: Toyota, Honda, Ford" required>
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
                                    placeholder="Ex: 2024, 2023/2024" required maxlength="10">
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
                            <textarea class="form-control" id="descricao" name="descricao"
                                rows="3" placeholder="Descreva características adicionais do veículo..."></textarea>
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

                    <div id="resultado-cadastro" class="mt-3"></div>
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
    document.getElementById('form-cadastro').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const resultado = document.getElementById('resultado-cadastro');
        const btnSubmit = form.querySelector('button[type="submit"]');
        const originalText = btnSubmit.innerHTML;

        // Mostrar loading
        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Salvando...';
        btnSubmit.disabled = true;

        // Coletar dados do formulário
        const formData = new FormData(form);
        const dados = Object.fromEntries(formData.entries());

        // Enviar para API
        fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
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
                if (status === 201) {
                    // Sucesso
                    resultado.innerHTML = `
                <div class="alert alert-success">
                    <h5><i class="bi bi-check-circle"></i> Automóvel cadastrado com sucesso!</h5>
                    <p><strong>ID:</strong> ${body.id}</p>
                    <p><strong>Nome:</strong> ${body.nome}</p>
                    <p><strong>Marca/Modelo:</strong> ${body.marca} ${body.modelo}</p>
                    <p class="mb-0">Redirecionando para a lista em 3 segundos...</p>
                </div>
            `;

                    // Limpar formulário
                    form.reset();

                    // Redirecionar após 3 segundos
                    setTimeout(() => {
                        window.location.href = '/automoveis';
                    }, 3000);

                } else if (status === 422) {
                    // Erro de validação
                    let erros = '<ul class="mb-0">';
                    for (const campo in body.errors) {
                        body.errors[campo].forEach(erro => {
                            erros += `<li>${campo}: ${erro}</li>`;
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
                    // Outro erro
                    resultado.innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> Erro ao cadastrar</h5>
                    <p>${body.message || body.erro || 'Erro desconhecido'}</p>
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
            })
            .finally(() => {
                // Restaurar botão
                btnSubmit.innerHTML = originalText;
                btnSubmit.disabled = false;
            });
    });
</script>
@endsection
