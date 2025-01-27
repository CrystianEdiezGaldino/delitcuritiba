document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const sidebar = document.getElementById('sidebar');
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const mainContent = document.querySelector('.main-content');
    
    // Toggle do Sidebar
    if (sidebarCollapse) {
        sidebarCollapse.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Salva o estado do menu no localStorage
            localStorage.setItem('sidebarState', sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
        });
    }

    // Recupera o estado do menu do localStorage
    const sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState === 'collapsed') {
        sidebar.classList.add('collapsed');
    }

    // Gerenciamento de Submenus
    const menuItems = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (!sidebar.classList.contains('collapsed')) {
                e.preventDefault();
                
                // Remove active de outros itens
                menuItems.forEach(menuItem => {
                    if (menuItem !== item) {
                        const submenu = document.querySelector(menuItem.getAttribute('data-bs-target'));
                        if (submenu) {
                            submenu.classList.remove('show');
                        }
                        menuItem.classList.remove('active');
                    }
                });

                // Toggle do item atual
                const submenu = document.querySelector(this.getAttribute('data-bs-target'));
                if (submenu) {
                    this.classList.toggle('active');
                    submenu.classList.toggle('show');
                }
            }
        });
    });

    // Hover nos submenus quando recolhido
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        const submenu = item.querySelector('.submenu');
        if (submenu) {
            item.addEventListener('mouseenter', function() {
                if (sidebar.classList.contains('collapsed')) {
                    submenu.style.display = 'block';
                    
                    // Posiciona o submenu
                    const itemRect = item.getBoundingClientRect();
                    submenu.style.top = `${itemRect.top}px`;
                    
                    // Verifica se o submenu vai sair da tela
                    const submenuRect = submenu.getBoundingClientRect();
                    if (submenuRect.bottom > window.innerHeight) {
                        submenu.style.top = `${window.innerHeight - submenuRect.height}px`;
                    }
                }
            });

            item.addEventListener('mouseleave', function() {
                if (sidebar.classList.contains('collapsed')) {
                    submenu.style.display = 'none';
                }
            });
        }
    });

    // Navegação entre páginas
    document.querySelectorAll('.nav-link[data-page]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active de todos os links
            document.querySelectorAll('.nav-link').forEach(navLink => {
                navLink.classList.remove('active');
            });
            
            // Adiciona active ao link clicado
            this.classList.add('active');

            // Carrega a página
            const page = this.getAttribute('data-page');
            loadPage(page);
        });
    });

    // Função para carregar páginas
    function loadPage(page) {
        fetch(`pages/${page}.php`)
            .then(response => response.text())
            .then(html => {
                document.querySelector('.main-content').innerHTML = html;
            })
            .catch(error => {
                console.error('Erro ao carregar página:', error);
            });
    }

    // Fecha submenus ao clicar fora
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target)) {
            document.querySelectorAll('.submenu.show').forEach(submenu => {
                submenu.classList.remove('show');
            });
            document.querySelectorAll('.nav-link.active').forEach(link => {
                if (link.hasAttribute('data-bs-toggle')) {
                    link.classList.remove('active');
                }
            });
        }
    });

    // Responsividade
    function handleResize() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
        }
    }

    window.addEventListener('resize', handleResize);
    handleResize(); // Executa ao carregar

    // Tooltips para menu recolhido
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        const text = link.querySelector('span')?.textContent;
        if (text) {
            link.closest('.nav-item').setAttribute('data-title', text);
        }
    });
});
