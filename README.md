# Symfony Product API - Test Technique

API REST avec back-office pour la gestion de produits et catégories.

## 🚀 Stack Technique

- Symfony 6.4
- API Platform
- EasyAdmin
- Messenger (traitement asynchrone)
- Doctrine ORM
- MySQL 8.0
- Docker

## 📋 Fonctionnalités

- ✅ API REST complète (GET, POST, PATCH)
- ✅ Relation ManyToMany Product ↔ Category
- ✅ Back-office d'administration
- ✅ Logs asynchrones des modifications produits

## 🐳 Installation avec Docker
```bash
# Cloner le projet
git clone https://github.com/oumaymasadeddine-jpg/Dhygietal-test.git
cd symfony-product-api

# Lancer les containers
docker-compose up -d

# Attendre que les services démarrent (30 secondes)
```

L'application sera accessible sur :
- **API** : http://localhost:8000/api
- **Back-office** : http://localhost:8000/admin

## 💻 Installation en local (sans Docker)
```bash
# Installer les dépendances
composer install

# Configurer la base de données dans .env
DATABASE_URL="mysql://root:@127.0.0.1:3306/symfony_product_api"

# Créer la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Configurer Messenger
php bin/console messenger:setup-transports

# Lancer le serveur
symfony server:start

# Dans un autre terminal : lancer le worker Messenger
php bin/console messenger:consume async -vv
```

## 🧪 Tester l'API

### Avec Swagger UI
Accédez à http://localhost:8000/api pour une interface interactive.

### Avec curl

**Créer une catégorie** :
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/json" \
  -d '{"designation": "Electronics"}'
```

**Créer un produit** :
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"designation": "Laptop Dell XPS", "categories": ["/api/categories/1"]}'
```

**Lister les produits** :
```bash
curl http://localhost:8000/api/products
```

**Modifier un produit (ajouter/modifier catégories)** :
```bash
curl -X PATCH http://localhost:8000/api/products/1 \
  -H "Content-Type: application/merge-patch+json" \
  -d '{"designation": "Laptop Updated", "categories": ["/api/categories/1", "/api/categories/2"]}'
```

## 📊 Vérifier les logs asynchrones

Les modifications de produits génèrent des logs en base via Messenger.
```bash
# Via Docker
docker-compose exec php php bin/console doctrine:query:sql "SELECT * FROM product_log"

# En local
php bin/console doctrine:query:sql "SELECT * FROM product_log"
```

## 🎯 Endpoints API

| Méthode | Endpoint | Description |
|---------|----------|-------------|
| GET | `/api/products` | Liste tous les produits |
| GET | `/api/products/{id}` | Détails d'un produit |
| POST | `/api/products` | Créer un produit |
| PATCH | `/api/products/{id}` | Modifier un produit |
| GET | `/api/categories` | Liste toutes les catégories |
| POST | `/api/categories` | Créer une catégorie |

## 🔐 Back-office

Accédez au back-office sur http://localhost:8000/admin

Fonctionnalités :
- CRUD complet Product avec sélection multiple de catégories
- CRUD complet Category

## 🏗️ Architecture
```
src/
├── Controller/Admin/        # Controllers EasyAdmin
├── Entity/                  # Entités Doctrine
├── EventListener/           # Listener Doctrine pour déclencher Messenger
├── Message/                 # Messages Messenger
├── MessageHandler/          # Handlers Messenger
└── Repository/              # Repositories Doctrine
```

## 📝 Commandes utiles
```bash
# Lancer les migrations
php bin/console doctrine:migrations:migrate

# Vider le cache
php bin/console cache:clear

# Voir les routes
php bin/console debug:router

# Consommer les messages Messenger
php bin/console messenger:consume async -vv
```
##  Filtres API (Bonus A)

Les produits peuvent être filtrés via l'API :

**Filtrer par designation (recherche partielle)** :
```bash
curl "http://localhost:8000/api/products?designation=Laptop"
```

**Filtrer par catégorie** :
```bash
curl "http://localhost:8000/api/products?categories.id=1"
```

**Combiner les filtres** :
```bash
curl "http://localhost:8000/api/products?designation=test&categories.id=1"
```

## 👨‍💻 Auteur

Développé par Oumayma sadeddine.