# NBA Player Stats
This project's goal is to get NBA players stats from current and previous years.
As there are no free available APIs I'm getting datasets from [Basketball Reference](https://www.basketball-reference.com).

The data will be used to make a website to compare players stats over the years. 

**-> This project is for learning purpose.**

## Learning goals
* Practice PHP
* Use a web scraping library
* Handle data in CSV and SQLite
* Transform raw data into charts
* Automate the retrieval of datasets for current season
* Build an API to decouple back and front

***
## Features
* Ask for player name
* Retrieve player's stats
* Get his stats from previous seasons to compare
* Display main stats in chart (points, assist, rebound)
* Display full stats in table

### Future features
* Compare several players on the same chart

***
## Tech used
(so far)
* PHP 
* Goutte
* SQLite

***
## Project Management / To Do :
* ~~Essayer d'organiser les résultats / ligne~~ 
* [X] Créer BDD
* [X] Vérifier que la BDD soit bien créée
* [X] Ecrire en BDD les résultats
* [X] Faire simple formulaire pour demander un nom + année
* [X] Ajouter la vérification des datas (required)
* [X] Gérer les erreurs : Nom non trouvé ou invalide
* [X] Display les résultats du formulaire en table
* [X] Récupérer l'année d'avant et l'afficher
* [X] Clean les data CSV (name + doublons + casse)
  * [X] Clean data deja enregistrée
* [X] Trouver un endroit où mettre la logique create table + insertion des nouvelles données
* [X] Transformer la recherche avec la casse ?
* [X] /!\ Retirer la proposition des années => pas besoin, juste un joueur et comparer avec l'année d'avant
* [X] Faire toutes les années (5ans)
* [X] Gérer les erreurs => pas 5 années de stats
* [X] Remplacer les char des joueurs de l'est
* API
  * Faire routing - A REVOIR
    * GET / => homepage
    * GET /api/player/nomdujoueur => retourne en json les stats 
  * [X] Faire méthodes Player
    * [X] $name
    * [X] $PDO
    * [X] $array data
    * [X] private find()
    * [X] public show() => renvoie $data
  * [X] Faire PlayerController
    * [X] Utilisation de Player

  * Réorganiser les dossiers ?
    * app/database
    * app/controller
  * Checker les headerm content type etc.  
* Display les résultats du formulaire en chart
* Ajout try/catch et exception pour les requêtes
* Sécurité
  * token csrf formulaire
* Front : framework JS ? Tailwind ?
* Automatiser la recherche de l'année en cours





