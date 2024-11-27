# Nursery Planning

## Description

**Nursery Planning** est une application web développée avec Symfony qui permet de dématérialiser la gestion des plannings des enfants en crèche. Elle simplifie les interactions entre les parents et la direction en offrant une solution numérique pour soumettre, consulter et gérer les demandes de planning mensuelles.

---


## Contexte

Dans de nombreuses crèches, les demandes de planning des enfants sont encore gérées manuellement, via des formulaires papier. Ce processus est chronophage, sujet aux erreurs, et peu pratique pour les parents comme pour la direction.

Avec **Nursery Planning**, la gestion des plannings devient numérique et centralisée. Cette solution permet :
- Aux parents de soumettre leurs demandes rapidement via une interface en ligne.
- À la direction de traiter les demandes plus efficacement, tout en ayant une vue d’ensemble des disponibilités.
- D’améliorer la communication et la transparence entre les deux parties.

---
## Fonctionnalités

### Pour les parents :
- Accès à un espace personnel pour soumettre les demandes de planning mensuelles.
- Possibilité de spécifier les dates et horaires d'arrivée et de départ.
- Consultation de l'historique des demandes et de leur statut (accepté, refusé, en attente).
- Notifications automatiques pour informer des décisions prises par la direction.

### Pour la direction :
- Consultation des demandes soumises par les parents.
- Validation, modification ou refus des plannings soumis.
- Affichage d’un aperçu global des demandes validées et en attente.
- Notifications automatiques envoyées aux parents après traitement.

---

## Processus de gestion des plannings

### 1. Soumission des demandes
- Les parents soumettent leurs demandes pour le mois suivant avant une date limite définie.
- Les informations requises incluent les dates souhaitées et les horaires d'arrivée/départ.

### 2. Validation ou modification
- La direction examine les demandes soumises et peut :
    - Accepter le planning dans son intégralité.
    - Modifier certaines dates ou horaires.
    - Refuser des dates spécifiques ou l’intégralité du planning, avec une justification obligatoire.

### 3. Notifications
- Les parents reçoivent automatiquement des notifications par e-mail ou via l’application pour les informer de l’état de leur demande (acceptée, refusée, modifiée).

---

## Technologies utilisées

- **Backend** : Symfony (PHP) pour la gestion des utilisateurs, demandes, et décisions.
- **Frontend** : Twig ou React.js pour une interface utilisateur intuitive et responsive.
- **Base de données** : MySQL ou PostgreSQL pour le stockage des informations.
- **Notifications** : Envoi d’e-mails via SwiftMailer ou Symfony Mailer.
- **Hébergement** : Déployé sur une infrastructure cloud (par exemple : AWS, OVH).

---

## Exemple d’utilisation

### Parent :
- Soumission d’une demande pour le mois suivant :
    - **Exemple** : Lundi : 8h00 - 16h00, Mercredi : 9h00 - 15h00.
- Notification automatique après validation ou modification par la direction.

### Direction :
- Consultation et modification des horaires en cas de conflit ou de surcharge :
    - **Exemple** : Modification du mercredi à 10h00 - 15h00, puis validation.

---

## Objectifs

Cette application vise à simplifier et centraliser la gestion des plannings des enfants en crèche, en réduisant la charge administrative pour la direction tout en offrant une meilleure expérience utilisateur pour les parents.

---


