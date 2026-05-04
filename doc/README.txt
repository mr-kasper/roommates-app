ROOMMATES APP - Instructions d'installation et de lancement

STRUCTURE DU PROJET
-------------------
Ce projet est organisé conformément aux exigences du mini-projet :
- index.php : point d'entrée principal
- config.php : connexion à la base de données et configuration globale
- /pages/ : toutes les pages PHP (dashboard, annonces, recherche, etc.)
- /includes/ : modèles réutilisables (header, footer)
- /css/ : feuilles de style
- /js/ : fichiers JavaScript
- /images/ : images utilisées dans le projet
- /php/ : fonctions et actions côté serveur
- /doc/ : documentation (README, captures, diagrammes)
- projet.sql : export de la base de données avec données de test

ÉTAPES D'INSTALLATION
---------------------
1. Décompressez le projet dans le dossier racine de votre serveur web.
2. Importez la base de données à l'aide du fichier SQL fourni avec le projet.
3. Vérifiez qu'Apache et MySQL sont démarrés dans XAMPP.
4. Ouvrez http://localhost/roommates-app/ dans le navigateur.

COMPTE PAR DÉFAUT POUR LES TESTS
--------------------------------
Remarque : l'application utilise une authentification par e-mail (et non par nom d'utilisateur).

Compte administrateur :
  E-mail : ENSIASD@gmail.com
  Mot de passe : ENSIASD2026

Comptes de test supplémentaires :
  - sara@example.com / Student123
  - youssef@example.com / Student123
  - mariam@example.com / Student123

FONCTIONNALITÉS
---------------
- Inscription et authentification des utilisateurs
- Recherche de colocataires avec filtres
- Création et gestion d'annonces
- Système de chat / messagerie
- Favoris / shortlist
- Gestion du profil
- Système de notifications
- Modération et statistiques administrateur

FONCTIONNALITÉS DE SÉCURITÉ
---------------------------
- Hachage des mots de passe (bcrypt)
- Authentification basée sur les sessions
- Protection CSRF sur les formulaires
- Requêtes préparées PDO
- Échappement des sorties pour limiter les attaques XSS
- Redirections sécurisées pour les flux de connexion

DÉPANNAGE
---------
- Échec de connexion à la base : vérifiez que MySQL est démarré et que les identifiants dans config.php sont corrects.
- Connexion impossible : videz les cookies du navigateur et vérifiez les comptes de test ci-dessus.
- Fichiers non chargés : vérifiez le chemin du projet et confirmez qu'Apache sert bien le dossier roommates-app.

NOTES COMPLÉMENTAIRES
---------------------
- Tous les fichiers téléversés sont stockés dans /uploads.
- Les fonctions utilitaires principales se trouvent dans /php/functions.php.
- Les modèles réutilisables se trouvent dans /includes/.
- Les actions liées à la base de données sont gérées par les scripts dans /php/.
- Version en ligne : https://roommates.free.nf/roommates-app/
