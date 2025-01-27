<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Maçônico - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Imagem Lateral -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-image">
                <div class="overlay"></div>
                <div class="text-center text-white position-relative">
                    <img src="assets/img/logo.png" alt="Logo" class="mb-4" style="max-width: 150px;">
                    <h2>Portal Maçônico</h2>
                    <p class="lead">Sabedoria, Força e Beleza</p>
                </div>
            </div>

            <!-- Formulário de Login -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="login-form w-100 px-5">
                    <h1 class="mb-4">Bem-vindo ao<br>Portal Maçônico</h1>
                    
                    <div id="loginMessage" class="alert d-none"></div>

                    <form action="<?= site_url('auth') ?>" method="post">
                        <div class="mb-4">
                            <label class="form-label">IME (CIM)</label>
                            <input type="text" class="form-control form-control-lg" name="ime" required 
                                   placeholder="Digite seu IME">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" name="senha" required 
                                       placeholder="Digite sua senha">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Lembrar-me</label>
                            </div>
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" 
                               data-bs-target="#forgotPasswordModal">Esqueci minha senha</a>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                            <button type="button" class="btn btn-outline-primary btn-lg" 
                                    data-bs-toggle="modal" data-bs-target="#firstAccessModal">
                                Primeiro Acesso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Primeiro Acesso -->
    <div class="modal fade" id="firstAccessModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Primeiro Acesso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="firstAccessForm">
                        <div class="mb-3">
                            <label class="form-label">IME (CIM)</label>
                            <input type="text" class="form-control" name="ime" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data de Iniciação</label>
                            <input type="date" class="form-control" name="initiation_date" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="submitFirstAccess">Solicitar Acesso</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Esqueci a Senha -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperação de Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label class="form-label">IME (CIM)</label>
                            <input type="text" class="form-control" name="ime" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail Cadastrado</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="submitForgotPassword">Recuperar Senha</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>
</html>
