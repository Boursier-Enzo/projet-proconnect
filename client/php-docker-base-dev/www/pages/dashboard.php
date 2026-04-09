<div id="dashboardContainer" class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>ProConnect</h2>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" onclick="switchPage('dashboard')">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Accueil</span>
            </a>
            <a href="#" class="nav-item" onclick="switchPage('files')">
                <span class="nav-icon">📁</span>
                <span class="nav-text">Mes Dossiers</span>
            </a>
            <a href="#" class="nav-item" onclick="switchPage('appointments')">
                <span class="nav-icon">📅</span>
                <span class="nav-text">Rendez-vous</span>
            </a>
            <a href="#" class="nav-item" onclick="switchPage('profile')">
                <span class="nav-icon">👤</span>
                <span class="nav-text">Profil</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <button class="btn btn-logout" onclick="logout()">Déconnexion</button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-left">
                <h1 id="pageTitle">Tableau de Bord</h1>
            </div>
            <div class="header-right">
                <div class="user-menu">
                    <span class="user-name" id="userName">Utilisateur</span>
                    <div class="user-avatar">👤</div>
                </div>
            </div>
        </header>

        <!-- Content Pages -->
        <div class="content-area">
            <!-- Dashboard Page -->
            <div class="page-content active" id="dashboardPage">
                <div class="welcome-card">
                    <h2>Bienvenue sur ProConnect</h2>
                    <p>Votre plateforme de gestion professionnelle</p>
                </div>

                <div class="dashboard-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📁</div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Dossiers</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">📅</div>
                        <div class="stat-info">
                            <h3>3</h3>
                            <p>Rendez-vous</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⏰</div>
                        <div class="stat-info">
                            <h3>2</h3>
                            <p>En attente</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-info">
                            <h3>1</h3>
                            <p>Complétés</p>
                        </div>
                    </div>
                </div>

                <!-- Services Section -->
                <div class="services-section">
                    <h3>Nos Services</h3>
                    <div class="services-grid">
                        <div class="service-card">
                            <div class="service-icon">📋</div>
                            <h4>Conseil Fiscal</h4>
                            <p>
                                Optimisation fiscale, déclaration d'impôts, conseils personnalisés pour
                                particuliers et entreprises.
                            </p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">💼</div>
                            <h4>Comptabilité</h4>
                            <p>
                                Tenue comptable, bilan annuel, suivi budgétaire et analyse financière pour votre
                                entreprise.
                            </p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">⚖️</div>
                            <h4>Conseil Juridique</h4>
                            <p>
                                Accompagnement juridique, contrats, contentieux et conseils en droit des
                                affaires.
                            </p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">📊</div>
                            <h4>Audit & Expertise</h4>
                            <p>Audit comptable, expertise financière et évaluation d'entreprises.</p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">🎯</div>
                            <h4>Stratégie d'Entreprise</h4>
                            <p>Conseil en stratégie, développement commercial et optimisation des processus.</p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">💰</div>
                            <h4>Gestion Patrimoniale</h4>
                            <p>
                                Conseil en investissement, gestion de patrimoine et optimisation successorale.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="features-section">
                    <h3>Pourquoi choisir ProConnect ?</h3>
                    <div class="features-grid">
                        <div class="feature-highlight">
                            <div class="feature-icon-large">🔒</div>
                            <h4>Sécurité & Confidentialité</h4>
                            <p>
                                Protection maximale de vos données avec chiffrement de bout en bout et
                                conformité RGPD.
                            </p>
                        </div>
                        <div class="feature-highlight">
                            <div class="feature-icon-large">⚡</div>
                            <h4>Rapidité d'Exécution</h4>
                            <p>Traitement rapide de vos demandes avec suivi en temps réel de l'avancement.</p>
                        </div>
                        <div class="feature-highlight">
                            <div class="feature-icon-large">👥</div>
                            <h4>Experts Qualifiés</h4>
                            <p>Équipe d'experts certifiés avec plus de 15 ans d'expérience moyenne.</p>
                        </div>
                        <div class="feature-highlight">
                            <div class="feature-icon-large">🌍</div>
                            <h4>Accompagnement Personnalisé</h4>
                            <p>
                                Solutions sur mesure adaptées à vos besoins spécifiques et à votre secteur
                                d'activité.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Practical Info Section -->
                <div class="info-section">
                    <h3>Informations Pratiques</h3>
                    <div class="info-grid">
                        <div class="info-card">
                            <h4>🕒 Horaires d'Ouverture</h4>
                            <div class="info-details">
                                <p><strong>Lundi - Vendredi:</strong> 8h30 - 18h00</p>
                                <p><strong>Samedi:</strong> 9h00 - 12h00</p>
                                <p><strong>Dimanche:</strong> Fermé</p>
                                <p class="info-note">Support d'urgence disponible 24/7</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <h4>📞 Modalités de Contact</h4>
                            <div class="info-details">
                                <p><strong>Téléphone:</strong> +33 (0)1 23 45 67 89</p>
                                <p><strong>Email:</strong> contact@proconnect.com</p>
                                <p><strong>Chat en ligne:</strong> Disponible 24/7</p>
                                <p><strong>Rendez-vous:</strong> Prise de RDV en ligne</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <h4>📍 Nos Bureaux</h4>
                            <div class="info-details">
                                <p><strong>Siège social:</strong></p>
                                <p>123 Avenue des Affaires<br />75008 Paris, France</p>
                                <p><strong>Agences:</strong> Lyon, Marseille, Bordeaux</p>
                                <p class="info-note">Téléconsultation disponible</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recent-section">
                    <h3>Récents</h3>
                    <div class="recent-list">
                        <div class="file-card">
                            <div class="file-icon">📅</div>
                            <div class="file-info">
                                <p class="item-name">Rendez-vous consultant</p>
                                <p class="item-date">Prévu pour demain</p>
                            </div>
                        </div>
                        <div class="file-card">
                            <div class="file-icon">📄</div>
                            <div class="file-info">
                                <p class="item-name">Dossier_Fiscalité_2026.pdf</p>
                                <p class="item-date">Ajouté il y a 2 mois</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Files Page -->
            <div class="page-content" id="filesPage">
                <div class="page-header">
                    <h2>Mes Dossiers</h2>
                    <button class="btn btn-secondary">+ Nouveau Dossier</button>
                </div>

                <div class="files-grid">
                    <div class="file-card">
                        <div class="file-icon">📄</div>
                        <div class="file-info">
                            <h3>Fiscalité 2026</h3>
                            <p>PDF • 2.4 MB</p>
                            <p class="file-date">15 mars 2026</p>
                        </div>
                        <div class="file-actions">
                            <button class="icon-btn">⬇️</button>
                            <button class="icon-btn">🔗</button>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-icon">📄</div>
                        <div class="file-info">
                            <h3>Contrats Professionnels</h3>
                            <p>PDF • 1.8 MB</p>
                            <p class="file-date">10 mars 2026</p>
                        </div>
                        <div class="file-actions">
                            <button class="icon-btn">⬇️</button>
                            <button class="icon-btn">🔗</button>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-icon">📊</div>
                        <div class="file-info">
                            <h3>Rapport d'Analyse</h3>
                            <p>Excel • 3.2 MB</p>
                            <p class="file-date">8 mars 2026</p>
                        </div>
                        <div class="file-actions">
                            <button class="icon-btn">⬇️</button>
                            <button class="icon-btn">🔗</button>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-icon">📋</div>
                        <div class="file-info">
                            <h3>Planning Annuel</h3>
                            <p>Word • 1.1 MB</p>
                            <p class="file-date">5 mars 2026</p>
                        </div>
                        <div class="file-actions">
                            <button class="icon-btn">⬇️</button>
                            <button class="icon-btn">🔗</button>
                        </div>
                    </div>

                    <div class="file-card">
                        <div class="file-icon">📑</div>
                        <div class="file-info">
                            <h3>Documentation Juridique</h3>
                            <p>PDF • 2.9 MB</p>
                            <p class="file-date">1 mars 2026</p>
                        </div>
                        <div class="file-actions">
                            <button class="icon-btn">⬇️</button>
                            <button class="icon-btn">🔗</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments Page -->
            <div class="page-content" id="appointmentsPage">
                <div class="page-header">
                    <h2>Rendez-vous</h2>
                    <button class="btn btn-secondary">+ Nouveau Rendez-vous</button>
                </div>

                <div class="appointments-list">
                    <div class="appointment-card">
                        <div class="appointment-time">
                            <span class="time">10:30</span>
                            <span class="date">09 avril</span>
                        </div>
                        <div class="appointment-info">
                            <h3>Consultation Fiscale</h3>
                            <p class="professional">Avec Jean Dupont</p>
                            <p class="location">📍 Bureau Paris Centre</p>
                        </div>
                        <div class="appointment-status confirmed">Confirmé</div>
                    </div>

                    <div class="appointment-card">
                        <div class="appointment-time">
                            <span class="time">14:00</span>
                            <span class="date">12 avril</span>
                        </div>
                        <div class="appointment-info">
                            <h3>Audit Comptable</h3>
                            <p class="professional">Avec Sarah Martin</p>
                            <p class="location">📍 Centre Affaires Lyon</p>
                        </div>
                        <div class="appointment-status pending">En attente</div>
                    </div>

                    <div class="appointment-card">
                        <div class="appointment-time">
                            <span class="time">11:00</span>
                            <span class="date">15 avril</span>
                        </div>
                        <div class="appointment-info">
                            <h3>Revision Légale</h3>
                            <p class="professional">Avec Marc Laurent</p>
                            <p class="location">📍 Visioconférence</p>
                        </div>
                        <div class="appointment-status pending">En attente</div>
                    </div>
                </div>
            </div>

            <!-- Profile Page -->
            <div class="page-content" id="profilePage">
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-avatar-large">👤</div>
                        <div class="profile-title">
                            <h2 id="profileName">Utilisateur</h2>
                            <p id="profileEmail">email@example.com</p>
                        </div>
                    </div>

                    <form class="profile-form">
                        <div class="form-section">
                            <h3>Informations Personnelles</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="profile-firstname">Prénom</label>
                                    <input type="text" id="profile-firstname" placeholder="Votre prénom" />
                                </div>
                                <div class="form-group">
                                    <label for="profile-lastname">Nom</label>
                                    <input type="text" id="profile-lastname" placeholder="Votre nom" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="profile-email">Email</label>
                                    <input type="email" id="profile-email" placeholder="Votre email" />
                                </div>
                                <div class="form-group">
                                    <label for="profile-phone">Téléphone</label>
                                    <input type="tel" id="profile-phone" placeholder="Votre téléphone" />
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Sécurité</h3>
                            <div class="form-group">
                                <label for="profile-password">Changer le mot de passe</label>
                                <input
                                    type="password"
                                    id="profile-password"
                                    placeholder="Nouveau mot de passe"
                                />
                            </div>
                            <div class="form-group">
                                <label for="profile-password-confirm">Confirmer le mot de passe</label>
                                <input
                                    type="password"
                                    id="profile-password-confirm"
                                    placeholder="Confirmez le mot de passe"
                                />
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>