# Définition des variables
DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = php

# 🛠️ Commandes Docker
up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

restart:
	$(DOCKER_COMPOSE) down && $(DOCKER_COMPOSE) up -d

logs:
	$(DOCKER_COMPOSE) logs -f

# 🔥 Symfony
sf-console:
	docker exec -it $(PHP_CONTAINER) php bin/console $(cmd)

sf-clear-cache:
	docker exec -it $(PHP_CONTAINER) php bin/console cache:clear --env=$(env)

sf-db-create:
	docker exec -it $(PHP_CONTAINER) php bin/console doctrine:database:create --env=$(env)

sf-db-drop:
	docker exec -it $(PHP_CONTAINER) php bin/console doctrine:database:drop --force --env=$(env)

sf-db-migrate:
	docker exec -it $(PHP_CONTAINER) php bin/console doctrine:migrations:migrate --env=$(env)

sf-db-load-fixtures:
	docker exec -it $(PHP_CONTAINER) php bin/console doctrine:fixtures:load --env=$(env)

# 🧪 Tests PHPUnit
test:
	docker exec -it $(PHP_CONTAINER) vendor/bin/phpunit

test-filter:
	docker exec -it $(PHP_CONTAINER) vendor/bin/phpunit --filter $(filter)

# ⚡ Commandes diverses
bash:
	docker exec -it $(PHP_CONTAINER) bash

mysql:
	docker exec -it $(PHP_CONTAINER) mysql -h bdd -uroot -proot symfony

# 🔄 Helpers
help:
	@echo "📌 Commandes disponibles :"
	@echo ""
	@echo "Docker :"
	@echo "  make up                - Démarrer les conteneurs"
	@echo "  make down              - Arrêter les conteneurs"
	@echo "  make restart           - Redémarrer les conteneurs"
	@echo "  make logs              - Afficher les logs"
	@echo ""
	@echo "Symfony :"
	@echo "  make sf-console cmd='commande'  - Exécuter une commande Symfony (ex: make sf-console cmd=cache:clear)"
	@echo "  make sf-clear-cache env=test   - Vider le cache Symfony"
	@echo "  make sf-db-create env=test     - Créer la base de données"
	@echo "  make sf-db-drop env=test       - Supprimer la base de données"
	@echo "  make sf-db-migrate env=test    - Exécuter les migrations"
	@echo "  make sf-db-load-fixtures env=test - Charger les fixtures"
	@echo ""
	@echo "Tests :"
	@echo "  make test               - Exécuter tous les tests PHPUnit"
	@echo "  make test-filter filter='TestClass' - Exécuter un test spécifique"
	@echo ""
	@echo "Divers :"
	@echo "  make bash               - Ouvrir un shell dans le conteneur PHP"
	@echo "  make mysql              - Se connecter à MySQL dans le conteneur"
