// Global state
let currentUser = null;
let currentPage = 'dashboard';

// Switch between login and signup forms
function switchAuth(form) {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    if (form === 'login') {
        loginForm.classList.add('active');
        signupForm.classList.remove('active');
    } else if (form === 'signup') {
        signupForm.classList.add('active');
        loginForm.classList.remove('active');
    }
}

// Switch to a different dashboard page
function switchPage(page) {
    // Remove active class from all nav items
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });

    // Add active class to clicked nav item
    event.target.closest('.nav-item').classList.add('active');

    // Hide all pages
    document.querySelectorAll('.page-content').forEach(content => {
        content.classList.remove('active');
    });

    // Show selected page
    const pageElement = document.getElementById(page + 'Page');
    if (pageElement) {
        pageElement.classList.add('active');
    }

    // Update page title
    const titles = {
        'dashboard': 'Tableau de Bord',
        'files': 'Mes Dossiers',
        'appointments': 'Rendez-vous',
        'profile': 'Mon Profil'
    };
    document.getElementById('pageTitle').textContent = titles[page] || 'Tableau de Bord';

    currentPage = page;
}

// Show dashboard and hide auth
function enterDashboard(userName) {
    currentUser = userName;

    // Update user name
    document.getElementById('userName').textContent = userName;
    document.getElementById('profileName').textContent = userName;
    document.getElementById('profileEmail').textContent = document.getElementById('login-email').value || document.getElementById('signup-email').value;

    // Hide auth, show dashboard
    document.getElementById('authContainer').classList.add('hidden');
    document.getElementById('dashboardContainer').classList.add('active');
}

// Logout
function logout() {
    currentUser = null;

    // Reset forms
    document.getElementById('loginFormEl').reset();
    document.getElementById('signupFormEl').reset();

    // Switch back to login
    switchAuth('login');

    // Show auth, hide dashboard
    document.getElementById('authContainer').classList.remove('hidden');
    document.getElementById('dashboardContainer').classList.remove('active');

    // Reset to dashboard page
    currentPage = 'dashboard';
    document.querySelector('.nav-item').classList.add('active');
}

// Reset form function
function resetForm() {
    document.querySelector('.profile-form').reset();
}

// Email validation helper
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Initialize event listeners on page load
document.addEventListener('DOMContentLoaded', function() {
    const loginFormEl = document.getElementById('loginFormEl');
    const signupFormEl = document.getElementById('signupFormEl');

    // Login form handler
    if (loginFormEl) {
        loginFormEl.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const rememberMe = document.getElementById('remember-me').checked;

            // Validation
            if (!email || !password) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Veuillez entrer une adresse email valide');
                return;
            }

            // Simulate successful login
            console.log('Login attempt:', {
                email: email,
                password: password,
                rememberMe: rememberMe
            });

            const userName = email.split('@')[0]; // Use part of email as username
            enterDashboard(userName);
        });
    }

    // Signup form handler
    if (signupFormEl) {
        signupFormEl.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('signup-name').value;
            const email = document.getElementById('signup-email').value;
            const phone = document.getElementById('signup-phone').value;
            const password = document.getElementById('signup-password').value;
            const termsAccepted = document.getElementById('terms').checked;

            // Validation
            if (!name || !email || !password) {
                alert('Veuillez remplir tous les champs obligatoires');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Veuillez entrer une adresse email valide');
                return;
            }

            if (password.length < 8) {
                alert('Le mot de passe doit contenir au moins 8 caractères');
                return;
            }

            if (!termsAccepted) {
                alert('Veuillez accepter les conditions d\'utilisation');
                return;
            }

            // Simulate successful signup
            console.log('Signup attempt:', {
                name: name,
                email: email,
                phone: phone,
                password: password
            });

            // Auto-login after signup
            document.getElementById('login-email').value = email;
            document.getElementById('login-password').value = password;
            enterDashboard(name);
        });
    }

    // Password forgotten handler
    const forgotPasswordLink = document.querySelector('.forgot-password');
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            if (!email) {
                alert('Veuillez d\'abord entrer votre email');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Veuillez entrer une adresse email valide');
                return;
            }

            alert('Un email de réinitialisation a été envoyé à ' + email);
        });
    }

    // Profile form handler
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Modifications enregistrées avec succès!');
        });
    }

    // Prevent nav link default behavior
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
});

// Optional: Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Escape key to logout
    if (e.key === 'Escape' && currentUser) {
        logout();
    }
});
