# Livre d'or

## 📖 Description
Ce projet est un livre d'or permettant aux utilisateurs de laisser des avis sur le site. Il est développé en PHP avec une gestion de base de données MySQL. Les utilisateurs peuvent s'inscrire, se connecter, modifier leur profil et poster des commentaires visibles par tous.

## 🛠️ Technologies utilisées
- **Langages** : PHP, HTML, CSS
- **Base de données** : MySQL (gérée avec phpMyAdmin)
- **Hébergement** : Plesk
- **Gestion de versions** : GitHub

## 📂 Structure du projet
```
/livreor
│── /assets          → Images et ressources
│── /css             → Fichiers CSS
│── /models          → Classes PHP
│   ├── Database.php → Connexion à la BDD
│   ├── User.php     → Gestion des utilisateurs
│   ├── Comment.php  → Gestion des commentaires
│── /pages           → Pages du site
│   ├── index.php        → Page d'accueil
│   ├── register.php     → Inscription
│   ├── login.php        → Connexion
│   ├── profil.php       → Modification du profil
│   ├── livre-or.php     → Affichage des commentaires
│   ├── commentaire.php  → Ajout de commentaire
│── /sql             → Fichier SQL
│   ├── livreor.sql  → Structure et contenu de la BDD
│── .gitignore       → Fichiers ignorés par Git
│── README.md        → Explication du projet
│── index.php        → Page principale
```

## 📌 Fonctionnalités
- Inscription et connexion des utilisateurs
- Modification du profil (login et mot de passe)
- Ajout de commentaires (uniquement pour les utilisateurs connectés)
- Affichage du livre d’or avec pagination et recherche
- Système de date pour les commentaires

## 📦 Installation
1. **Cloner le projet** :
   ```bash
   git clone https://github.com/ton-github/livre-or.git
   ```
2. **Importer la base de données** :
   - Aller sur phpMyAdmin
   - Créer une base de données `livreor`
   - Importer le fichier `livreor.sql`



