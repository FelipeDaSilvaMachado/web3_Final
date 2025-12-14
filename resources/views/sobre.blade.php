@extends('layouts.app')

@section('title', 'Sobre o Sistema')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Sobre o Sistema de Automóveis
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-3">API RESTful de Gerenciamento de Automóveis</h5>
                            <p class="lead">
                                Sistema desenvolvido com <strong>Laravel</strong> para gestão completa de uma frota de veículos,
                                incluindo API RESTful para integração com outros sistemas.
                            </p>

                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">
                                                <i class="bi bi-check-circle me-2"></i>Funcionalidades
                                            </h6>
                                            <ul class="list-unstyled">
                                                <li class="mb-1">
                                                    <i class="bi bi-check text-success me-2"></i>CRUD completo de automóveis
                                                </li>
                                                <li class="mb-1">
                                                    <i class="bi bi-check text-success me-2"></i>API RESTful com endpoints JSON
                                                </li>
                                                <li class="mb-1">
                                                    <i class="bi bi-check text-success me-2"></i>Interface responsiva com Bootstrap
                                                </li>
                                                <li class="mb-1">
                                                    <i class="bi bi-check text-success me-2"></i>Validação de dados robusta
                                                </li>
                                                <li class="mb-1">
                                                    <i class="bi bi-check text-success me-2"></i>Documentação interativa
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">
                                                <i class="bi bi-tools me-2"></i>Tecnologias
                                            </h6>
                                            <ul class="list-unstyled">
                                                <li class="mb-1">
                                                    <span class="badge bg-primary me-2">Laravel 10+</span> Backend PHP
                                                </li>
                                                <li class="mb-1">
                                                    <span class="badge bg-info me-2">Bootstrap 5</span> Frontend
                                                </li>
                                                <li class="mb-1">
                                                    <span class="badge bg-success me-2">MySQL</span> Banco de dados
                                                </li>
                                                <li class="mb-1">
                                                    <span class="badge bg-warning me-2">REST API</span> Integração
                                                </li>
                                                <li class="mb-1">
                                                    <span class="badge bg-secondary me-2">Git</span> Controle de versão
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="bi bi-mortarboard me-2"></i>Informações Acadêmicas
                                    </h6>
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="150">Instituição:</th>
                                            <td>ETEC</td>
                                        </tr>
                                        <tr>
                                            <th>Curso:</th>
                                            <td>Desenvolvimento de Sistemas</td>
                                        </tr>
                                        <tr>
                                            <th>Semestre:</th>
                                            <td>Terceiro Semestre</td>
                                        </tr>
                                        <tr>
                                            <th>Disciplina:</th>
                                            <td>Web III - Programação Web</td>
                                        </tr>
                                        <tr>
                                            <th>Professor:</th>
                                            <td>Sílvio</td>
                                        </tr>
                                        <tr>
                                            <th>Aluno:</th>
                                            <td>Felipe da Silva Machado</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bi bi-car-front display-1 text-primary mb-3"></i>
                                    <h5>Sistema de Automóveis</h5>
                                    <p class="text-muted">Versão 1.0.0</p>

                                    <div class="mt-4">
                                        <div class="d-grid gap-2">
                                            <a href="/api/automoveis" target="_blank" class="btn btn-outline-primary">
                                                <i class="bi bi-code me-1"></i>Ver API JSON
                                            </a>
                                            <a href="/automoveis" class="btn btn-outline-success">
                                                <i class="bi bi-list-ul me-1"></i>Ver Automóveis
                                            </a>
                                            <a href="/" class="btn btn-outline-info">
                                                <i class="bi bi-house me-1"></i>Página Inicial
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="bi bi-shield-check me-2"></i>Endpoints da API
                                    </h6>
                                    <div class="mb-2">
                                        <small><strong>GET</strong> /api/automoveis</small><br>
                                        <small class="text-muted">Lista todos os automóveis</small>
                                    </div>
                                    <div class="mb-2">
                                        <small><strong>POST</strong> /api/automoveis</small><br>
                                        <small class="text-muted">Cadastra novo automóvel</small>
                                    </div>
                                    <div class="mb-2">
                                        <small><strong>GET</strong> /api/automoveis/{id}</small><br>
                                        <small class="text-muted">Mostra um automóvel específico</small>
                                    </div>
                                    <div class="mb-2">
                                        <small><strong>PUT/PATCH</strong> /api/automoveis/{id}</small><br>
                                        <small class="text-muted">Atualiza um automóvel</small>
                                    </div>
                                    <div>
                                        <small><strong>DELETE</strong> /api/automoveis/{id}</small><br>
                                        <small class="text-muted">Remove um automóvel</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="btn-group" role="group">
                            <a href="/" class="btn btn-primary">
                                <i class="bi bi-house me-1"></i> Página Inicial
                            </a>
                            <a href="/api/documentacao" class="btn btn-info">
                                <i class="bi bi-code-slash me-1"></i> Documentação Completa
                            </a>
                            <a href="/automoveis/create" class="btn btn-success">
                                <i class="bi bi-plus-circle me-1"></i> Cadastrar Automóvel
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>
                        Sistema desenvolvido para fins educacionais &copy; {{ date('Y') }} - ETEC
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
