# futChampions-manage

## Contexte du projet

Le projet vise à développer le backend d’une plateforme pour FUT Champions Ultimate Team, en utilisant PHP procédural et MySQLi. L'objectif principal est de créer un gestionnaire de contenu efficace et robuste, facilitant la gestion des joueurs, des équipes, des nationalités, et d'autres entités associées.

## Fonctionnalités Backend

### 1. **Analyse et Optimisation des Données**

- **Conception de la base de données** : Une analyse approfondie du fichier JSON fourni est effectuée pour créer une structure de base de données optimale.
- **Normalisation des données** : Réduction de la redondance et optimisation des attributs en appliquant les principes de normalisation des bases de données.
- **Création de schémas relationnels** : Gestion des entités (joueurs, équipes, nationalités) et de leurs relations dans une base de données relationnelle.

### 2. **Gestion des Entités**

- **Interface de gestion** : Implémentation d'une interface permettant d'ajouter, modifier, supprimer et lister les entités.
- **Relations entre entités** : Gestion des relations, par exemple, associer un joueur à une équipe et à une nationalité.

### 3. **Tableau de Bord et Statistiques**

- **Tableau de bord dynamique** : Conception d’un tableau de bord permettant de visualiser des statistiques clés comme le nombre de joueurs, la répartition par nationalité, et les performances des équipes.

## Installation

### Prérequis

- PHP 7.4 ou supérieur
- Serveur MySQL ou MariaDB
- Web serveur comme Apache ou Nginx ou Xampp

### Étapes d'installation

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Salma-007/futChampions-manage.git