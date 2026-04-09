<div id="authContainer" class="auth-container-full active">
    <div class="auth-wrapper">
        <div class="auth-brand">
            <h1>ProConnect</h1>
            <p>Plateforme de gestion professionnelle</p>
        </div>

        <!-- Login Form -->
        <div class="auth-form login-form active" id="loginForm">
            <h3>Connexion</h3>
            <form id="loginFormEl">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" placeholder="Votre email" required />
                </div>
                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" placeholder="Votre mot de passe" required />
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="remember-me" />
                    <label for="remember-me">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
            <p class="auth-switch">
                Pas encore inscrit?
                <a href="#" onclick="switchAuth('signup')">Créer un compte</a>
            </p>
            <a href="#" class="forgot-password">Mot de passe oublié?</a>
        </div>

        <!-- Signup Form -->
        <div class="auth-form signup-form" id="signupForm">
            <h3>Inscription</h3>
            <form id="signupFormEl">
                <div class="form-group">
                    <label for="signup-name">Nom complet</label>
                    <input type="text" id="signup-name" placeholder="Votre nom" required />
                </div>
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" placeholder="Votre email" required />
                </div>
                <div class="form-group">
                    <label for="signup-phone">Téléphone</label>
                    <input type="tel" id="signup-phone" placeholder="Votre téléphone" />
                </div>
                <div class="form-group">
                    <label for="signup-password">Mot de passe</label>
                    <input type="password" id="signup-password" placeholder="Créer un mot de passe" required />
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="terms" required />
                    <label for="terms">J'accepte les conditions d'utilisation</label>
                </div>
                <button type="submit" class="btn btn-primary">Créer un compte</button>
            </form>
            <p class="auth-switch">
                Déjà inscrit?
                <a href="#" onclick="switchAuth('login')">Se connecter</a>
            </p>
        </div>
    </div>
</div>