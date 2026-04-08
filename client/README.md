# 📁 Projet ProConnect – Organisation des dossiers

Ce document explique **à quoi sert chaque dossier** dans le projet.
Objectif : comprendre où mettre chaque type de fichier.

---

## 📂 `/pages`

Contient les **pages visibles du site**.

👉 On met ici :

* les pages PHP principales
* le HTML + un peu de PHP

📌 Exemples :

* page d’accueil
* page formulaire
* page documents

---

## 📂 `/ui`

Contient les **éléments d’interface réutilisables**.

👉 On met ici :

* le header (haut de page)
* le footer (bas de page)
* la navbar (menu)

📌 Objectif :
éviter de répéter le même code sur toutes les pages

---

## 📂 `/bdd`

Contient tout ce qui concerne la **base de données**.

👉 On met ici :

* la connexion à la base (PDO)
* les fonctions pour lire / écrire en base

📌 Exemple :

* récupérer des documents
* enregistrer une demande

---

## 📂 `/traitements`

Contient le **traitement des formulaires**.

👉 On met ici :

* le code qui reçoit les données (POST)
* les insertions en base
* les redirections

📌 Exemple :

* traitement d’un formulaire de contact
* ajout d’une demande

---

## 📂 `/assets`

Contient tout ce qui concerne le **design du site**.

---

### 📂 `/assets/css`

👉 On met ici :

* les fichiers CSS

📌 Exemple :

* style.css

---


### 📂 `/assets/images`

👉 On met ici :

* toutes les images du site

📌 Exemple :

* logo
* icônes
* illustrations

---


## 📄 `/index.php`

C’est le **point d’entrée du site**.

👉 Il sert à :

* afficher les pages
* gérer la navigation

---

# 🎯 Résumé simple

👉 Chaque dossier a un rôle :

* pages → affichage
* ui → morceaux de page
* bdd → base de données
* traitements → logique des formulaires
* assets → design

---

# 🧠 Règle à retenir

👉 **Toujours mettre les fichiers au bon endroit**
👉 **Ne pas mélanger les rôles des dossiers**

---

# ✅ Objectif pédagogique

Avec cette organisation :

* le projet est plus clair
* plus facile à maintenir
* plus professionnel
