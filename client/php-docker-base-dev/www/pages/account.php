<!-- Navigation -->
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <span class="logo-box"><img src="assets/images/logo.svg" alt=""></span>
            <span class="logo-text">ProConnect</span>
        </div>
        <a href="/"><div class="cta-btn">Retour</div></a>
    </div>
</nav>


<?php if ($account) : ?>
    <form action="" method="post">
        <button type="submit" id="signOut" name="origin" value="signOut"></button>
    </form>
    <script>
        document.getElementById("signOut").click()
    </script>
<?php else : ?>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-info">
            <span>Accès sécurisé</span>
            <h2>Bienvenue sur ProConnect</h2>
            <p>Connectez-vous pour accéder à votre espace personnel ou créez un compte pour suivre vos demandes et vos rendez-vous.</p>
            <div class="auth-actions">
                <button type="button" class="btn btn-primary auth-switch active" data-target="login">Connexion</button>
                <button type="button" class="btn btn-primary auth-switch" data-target="register">Créer un compte</button>
            </div>
        </div>

        <div class="auth-panel">
            <form id="login" class="auth-form active" method="post" action="">
                <h3>Connexion</h3>
                <input type="hidden" name="origin" value="login" />
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input id="login-email" type="email" name="email" placeholder="email@exemple.com" required />
                </div>
                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <input id="login-password" type="password" name="password" placeholder="Entrez votre mot de passe" required />
                </div>
                <div class="form-row-inline">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember" checked/>
                        Se souvenir de moi
                    </label>
                    <a href="#" class="auth-link">Mot de passe oublié ?</a>
                </div>
                <button type="submit" name="origin" value="signIn" class="btn btn-primary">Se connecter</button>
            </form>

            <form id="register" class="auth-form" method="post" action="">
                <h3>Créer un compte</h3>
                <input type="hidden" name="origin" value="register" />
                <div class="form-row-inline">
                    <div class="form-group">
                        <label for="register-name">Prénom</label>
                        <input id="register-name" type="text" name="firstName" placeholder="Votre nom complet" required />
                    </div>
                    <div class="form-group">
                        <label for="register-name">Nom</label>
                        <input id="register-name" type="text" name="lastName" placeholder="Votre nom complet" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input id="register-email" type="email" name="email" placeholder="email@exemple.com" required />
                </div>
                <div class="form-group">
                    <label for="register-phone">Téléphone</label>
                    <input id="register-phone" type="tel" name="phone" placeholder="+33 6 12 34 56 78" />
                </div>
                <div class="form-group">
                    <label for="register-password">Mot de passe</label>
                    <input id="register-password" type="password" name="password" placeholder="Choisissez un mot de passe" required />
                </div>
                <button type="submit" name="origin" value="signUp" class="btn btn-primary">Créer mon compte</button>
            </form>
        </div>
    </div>
</div>

<script>
    // switch entre connection et inscription
    document.querySelectorAll('.auth-switch').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.auth-switch').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const target = button.getAttribute('data-target');
            document.querySelectorAll('.auth-form').forEach(form => {
                form.classList.toggle('active', form.id === target);
            });
        });
    });
</script>
<?php endif; ?>