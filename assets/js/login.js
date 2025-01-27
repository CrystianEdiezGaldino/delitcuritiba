document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginMessage = document.getElementById('loginMessage');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Mostra mensagem de carregamento
        showMessage('Processando...', 'info');
        
        fetch('auth/login_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showMessage('Login realizado com sucesso!', 'success');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                showMessage(data.message || 'Erro ao fazer login', 'danger');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showMessage('Erro ao processar login. Tente novamente.', 'danger');
        });
    });

    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        const passwordInput = document.querySelector('input[name="senha"]');
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }

    function showMessage(message, type) {
        if (!loginMessage) return;
        
        loginMessage.className = `alert alert-${type}`;
        loginMessage.textContent = message;
        loginMessage.classList.remove('d-none');

        if (type !== 'info') {
            setTimeout(() => {
                loginMessage.classList.add('d-none');
            }, 5000);
        }
    }
});
