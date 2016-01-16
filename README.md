# IUT-ProgServer

## Description

Projet réalisé dans le cadre du cours de programmation web coté serveur prodigué au sein du département informatique de l'IUT de Bordeaux.

## Objectif

Il s'agit de construire un site web de type e-commerce s'appuyant sur la base de données de musique Classique_Web disponible sur le serveur info-simplet.

## Tâches

- [x] Une page d'accueil présentant le site,
- [x] Faire une page json permettant d'ajouter un element au panier de session
- [x] Une zone sécurisée (donc avec connexion et suivi de session) permettant de construire un panier d'achat.
- [x] Recoder la page de session de profil, les achats ne sont pas dans la base mais dans les sessions
- [x] Un menu facilitant la navigation dans le site
- [x] Un ensemble de pages constituant un catalogue et permettant de parcourir le contenu de la base (par exemple : un lien qui à partir d'une initiale permet d'accéder aux oeuvres d'un compositeur, puis aux albums contenant des enregistrements de ces oeuvres, et enfin aux enregistrement eux-mêmes), Chaque fois que c'est pertinent, affichage de la photo des musiciens ou de la pochette d'un album, affichage d'un contrôle permettant d'écouter l'extrait de l'enregistrement concerné.
- [x] Une page nommée converter prenant comme paramètre le type de fichier devant être retourné et le blob du fichier à retourner, chargé de convertir des données Blob de la base vers un fichier.
- [x] Linker l'authentification du site avec le base de donnée (Abonné)
- [x] Une page "à propos", décrivant le travail réalisé et précisant la liste des auteurs du site 
(le binôme), et éventuellement les difficultés rencontrées
- [x] Depuis la page décrivant un album, un accès aux services Amazon affichant les informations sur 
l'album (détails, prix, ...) grâce à la valeur contenue dans le champ ASIN de la table Album (en utilisant l'API Amazon ), ou la liste des albums semblables disponibles lorsque ce champ n'est pas renseigné (pas un simple renvoi sur une page !).
