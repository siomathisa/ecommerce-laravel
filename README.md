# 🛍️ Projet E-commerce Laravel

Un site e-commerce complet développé avec **Laravel**, permettant à des utilisateurs de :
- parcourir et acheter des produits,
- gérer un panier,
- passer des commandes,
- et à un administrateur de gérer le catalogue et les ventes.

---

## 🚀 Aperçu

> Projet full-stack PHP / Laravel — développé en autodidacte

### Fonctionnalités principales :
- 🔐 Authentification (inscription, connexion, rôles utilisateur/admin)
- 🧱 Gestion des produits (CRUD complet)
- 🛒 Panier fonctionnel (ajout, suppression, total dynamique)
- 📦 Commandes avec mise à jour du stock
- 🧰 Espace administrateur pour gérer les commandes et leur statut
- 💅 Interface responsive avec TailwindCSS

---

## ⚙️ Stack technique

| Catégorie | Technologies |
|------------|---------------|
| **Langage principal** | PHP 8 / Laravel 11 |
| **Base de données** | MySQL |
| **Front-end** | Blade, TailwindCSS |
| **Outils** | Laragon, Composer, Git, GitHub |
| **Méthode** | MVC (Model-View-Controller) |

---

## 🧩 Structure du projet

```bash
app/
├── Http/
│ ├── Controllers/
│ │ ├── ProductController.php
│ │ ├── CartItemController.php
│ │ ├── OrderController.php
│ │ └── Admin/
│ │ ├── ProductAdminController.php
│ │ └── OrderAdminController.php
│
├── Models/
│ ├── Product.php
│ ├── CartItem.php
│ ├── Order.php
│
resources/
├── views/
│ ├── products/
│ ├── cart/
│ ├── orders/
│ ├── admin/
│ └── layouts/
```

---

## 🔄 Logique d’application

1. **Authentification**  
   Laravel Breeze gère l’inscription et la connexion.  
   Un champ `is_admin` distingue les comptes administrateurs.

2. **Produits**  
   Les produits sont stockés dans la table `products` avec `name`, `description`, `price`, `stock`.  
   Les administrateurs peuvent créer, modifier ou supprimer des produits.

3. **Panier et commandes**  
   - Chaque utilisateur peut ajouter des produits à son panier (`cart_items`).
   - Lorsqu’il passe commande, une nouvelle entrée `order` est créée.
   - Le stock est automatiquement réduit pour chaque produit commandé.

4. **Espace admin**  
   - Accessible uniquement aux administrateurs (`middleware`).
   - Vue de toutes les commandes avec mise à jour du statut possible.

---

## 💡 Points techniques clés

- **Middleware personnalisé** pour protéger les routes admin.  
- **Relations Eloquent** :  
  - `User` ↔ `Order` ↔ `OrderItem`  
  - `User` ↔ `CartItem` ↔ `Product`
- **Gestion du stock** automatique lors de la validation d’une commande.  
- **Front-end** basé sur **TailwindCSS**, avec une **navbar responsive** incluant le compteur du panier.

---

## ⚠️ Problèmes rencontrés et solutions

| Problème | Solution |
|-----------|-----------|
| Migrations dupliquées | Utilisation de `php artisan migrate:fresh` |
| Middleware non reconnu | Déplacement correct des contrôleurs et héritage de `Controller` |
| Erreurs d’accès admin | Vérification du champ `is_admin` dans le middleware |
| Gestion du panier | Utilisation d’un modèle `CartItem` lié à `User` et `Product` |

---

## 🧑‍💻 Auteur

**Mathis Vidueira**  
🎓 Étudiant en Bachelor 3 – Développement Web  
🔗 [Mon portfolio](https://mathisvidueira-portfolio.vercel.app/)

---

## 🧭 Installation (pour test local)

```bash
# Cloner le dépôt
git clone https://github.com/siomathisa/ecommerce-laravel.git

# Installer les dépendances
composer install
npm install && npm run dev

# Configurer le fichier .env
cp .env.example .env
php artisan key:generate

# Créer la base de données et lancer les migrations
php artisan migrate --seed

# Lancer le serveur local
php artisan serve
