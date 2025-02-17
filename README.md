# 📖 Livre d'or - Mariage de Anne & Brad

## 📝 Description
Ce projet est un livre d'or permettant aux utilisateurs de laisser leurs avis et messages sur le mariage fictif de **Anne et Brad**. Cette idée humoristique fait référence à l'histoire d'Anne, une femme qui a été arnaquée par un individu se faisant passer pour Brad Pitt. Nous avons décidé d'ajouter cette touche légère et décalée à notre projet. 😆

## 🚀 Fonctionnalités
- **Page d'accueil** présentant le mariage et l'événement 📜
- **Inscription et connexion** pour permettre aux utilisateurs de laisser un message 🔑
- **Modification du profil** avec possibilité de changer son login et son mot de passe ✏️
- **Affichage des commentaires** du plus récent au plus ancien 🗣️
- **Ajout de commentaires** pour les utilisateurs connectés 💬
- **Recherche de commentaires** par mots-clés 🔍
- **Pagination** pour une meilleure lisibilité 📄

## 🛠️ Technologies utilisées
- **Back-end :** PHP (Programmation Orientée Objet)
- **Base de données :** MySQL (via phpMyAdmin)
- **Front-end :** HTML, CSS

## 📂 Structure du dépôt
```
/livreor
│── /assets        → Contient les images et ressources
│── /css           → Fichiers CSS pour le design
│── /models        → Classes PHP pour la gestion des données
│── /pages         → Fichiers accessibles par les utilisateurs
│── /sql           → Script de création de la base de données
│── .gitignore     → Fichiers à exclure du versionnement
│── index.php      → Page d'accueil
│── README.md      → Explication du projet
```

## 💻 Installation
1. **Cloner le dépôt**
   ```sh
   git clone https://github.com/prenom-nom/livre-or.git
   ```
2. **Configurer la base de données**
   - Importer le fichier SQL situé dans le dossier `/sql` dans phpMyAdmin.
   - Mettre à jour les informations de connexion à la BDD dans `Database.php`.
3. **Démarrer le projet**
   - Héberger les fichiers sur Plesk ou un serveur local (XAMPP, WAMP, MAMP).
   - Accéder à `http://localhost/livreor/` pour commencer. 🚀

## 🤝 Contribution
- Créer une branche à partir de `develop`
- Travailler sur la fonctionnalité et tester avant de proposer une fusion
- Respecter la structure et la convention de code définies



