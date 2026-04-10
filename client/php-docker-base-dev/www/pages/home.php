<!-- Navigation -->
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <span class="logo-box"><img src="assets/images/logo.svg" alt=""></span>
            <span class="logo-text">ProConnect</span>
        </div>
        <ul class="nav-menu">
            <li><a href="#accueil">Accueil</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#download">Fichiers</a></li>
            <li><a href="account"><div class="cta-btn"><?=$account ? "Se déconnecter" : "Se connecter"?></div></a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="accueil">
    <div class="hero-content">
        <span class="hero-tag">Solution professionnelle</span>
        <h1>Votre espace<br>de gestion<br>personnalisé</h1>
        <p>Prendre contact, soumettre vos demandes et accédez à vos documents en toute sécurité.</p>
        <div class="hero-buttons">
            <a href="#contact"><div class="btn btn-primary">Soumettre une demande</div></a>
            <a href="#download"><div class="btn btn-secondary">Récupérer un document</div></a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <h2>Comment pouvons-nous vous accompagner ?</h2>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">📋</div>
            <h3>Rendez-vous</h3>
            <p>Sélectionnez un créneau et nous vous recontacterons dans les plus brefs délais.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">📁</div>
            <h3>Dépôt de demande</h3>
            <p>Soumettez vos documents directement en ligne avec suivi à temps réel.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">🔒</div>
            <h3>Consultation sécurisée</h3>
            <p>Accédez à vos documents de manière sécurisée via votre compte personnel.</p>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section" id="contact">
    <div class="contact-form-container">
        <span class="form-label">Formulaire de contact</span>
        <h2>Décrivez votre besoin</h2>
        <p>Nous vous recontacterons sous 48h ouvrables.</p>

        <form class="contact-form" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label>Type de prestation</label>
                    <select name="prestation">
                        <option value="">--choisir une option--</option>
                        <option value="consultation">consultation</option>
                        <option value="devis">devis</option>
                        <option value="rendez-vous">rendez-vous</option>
                        <option value="permis">permis</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Créneau souhaité</label>
                    <input name="time" type="text" placeholder="matin en semaine" required>
                </div>
            </div>

            <div class="form-group full-width">
                <label>Objet de la demande</label>
                <textarea placeholder="Décrivez votre demande en détail..." rows="6" name="body" required></textarea>
            </div>

            <button type="submit" name="origin" value="demand" class="btn btn-submit" <?=!$account ? 'disabled="disabled"' : ''?> ><?=$account ? 'Envoyer ma demande' : 'Vous devez être connecté pour envoyer une demande'?></button>
        </form>
    </div>
</section>

<!-- section pour récupérer un fichier avec son code -->
<section id="download" class="download-section">
    <div class="download-container">
        <div class="download-header">
            <span class="section-label">Téléchargement sécurisé</span>
            <h2>Récupérez votre document</h2>
            <p>Entrez le code de téléchargement qui vous a été fourni pour accéder au fichier.</p>
        </div>

        <form class="download-form" action="#download" method="get">
            <input type="text" name="file" placeholder="Entrez votre code de téléchargement" required />
            <button type="submit" class="btn btn-primary">Récupérer le fichier</button>
        </form>

        <?php if (isset($_GET['file'])) {
        $fileInfo = search_data("document", ["titre", "type_document", "fichier_path", "updated_at"], ["uuid" => $_GET['file']]);
        if ($fileInfo) :?>
            <div class="file-info-card">
                <span class="file-info-tag">Fichier trouvé</span>
                <h3><?= $fileInfo['titre'] ?></h3>
                <p><strong>Type :</strong> <?= $fileInfo['type_document'] ?></p>
                <p><strong>Modifié le :</strong> <?= date('d/m/Y à H:i', strtotime($fileInfo['updated_at'])) ?></p>
                <a href="files/<?=$fileInfo['fichier_path'] ?>" download="<?= $fileInfo['titre'] ?>" class="btn btn-download">Télécharger</a>
            </div>
        <?php else : ?>
            <div class="file-info-card file-info-empty">
                <p>Aucun fichier trouvé pour ce code.</p>
            </div>
        <?php endif; } ?>
    </div>
</section>