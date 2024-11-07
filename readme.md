# Pokemon MVC

Voici les instructions d'installation du projet localement.

## Vous pouvez utiliser : 
- Notre configuration prête à l'emploi avec `ddev` (un wrapper de docker) (recommandé)
- Votre propre outil comme MAMP, XAMPP, Laragon ... 
- Votre propre configuration docker

Dans les deux derniers cas la génération des styles et/ou de l'accés BDD n'est pas prêt à l'emploi et peut vous prendre du temps.

## Installation avec ddev (recommandé)

### Installer ddev et docker

> <br>**Aller sur les sites dédiés pour installer ces deux outils** <br><br>
> [voir le site d'installation de ddev](https://ddev.readthedocs.io/en/stable/)<br>
> [voir le site d'installation de docker](https://www.docker.com/)

### Lancer ddev avec les commandes suivantes une à une :
1. `ddev start`<br>
2. `ddev composer install`<br>
3. `ddev composer dump-autoload`<br>
4. *Sur un autre terminal*:<br>
    ```sh
    ddev exec npx tailwindcss -i ./assets/style.css -o ./assets/output.css 
    ```
4. *Sur un autre terminal (ouvre une fenêtre pop up):*
`ddev launch`<br>

### (Si besoin) - Configurer la base de donnée local avec ddev

*Si elle n'est pas déjà configurée, voici la marche à suivre:*

Ajouter les variable d'environnement ci-dessous à `.ddev/config.yaml` dans <br>`web_environment:[ici...]`:
```sh
"DB_HOST=db",
"DB_USER=root",
"DB_PASSWORD=root",
"DB_NAME=db",
"DB_DRIVER=mysql",
"APP_ENV=local",
"APP_DEBUG=true"
```

Puis lancer : `ddev restart`

Puis importez le dump de la base de donnée :<br>
```bash
ddev import-db --file="database/.db.sql"
```
<br>

*Si besoin, pour avoir accés à phpmyadmin:* <br>
`ddev get ddev/ddev-phpmyadmin`

### (Si besoin) ddev et composer
Pour installer les dépendances si elles ne le sont pas déjà : 
`ddev composer install`

En cas de besoin de (re)générer l'autoload (php): `ddev composer dump-autoload`

## Si vous utilisez notre configuration avec docker :
```bash
docker compose up -d --build
```

Puis aller sur `localhost:8091` pour accéder à adminer et importez le dump présent dans `database/db.sql`

puis pour avoir le style : 
```bash
docker compose exec php-dev npx tailwindcss -i ./assets/style.css -o ./assets/output.css
```
Acceptez l'installation demandé de tailwind (taper Entrer) et le style sera compilé.

## Si vous utilisez votre configuration personnelle locale (avec ou sans docker) :
- Le dump de la bdd mysql est dans `database/db.sql`
- Le projet est configuré avec vite js, npm, composer avec l'autoload <br>
`composer install` - `composer dump-autoload` | `npx tailwindcss -i ./assets/style.css -o ./assets/output.css`
- Le css (tailwind) se trouve dans `/assets/style.css`

NB: Si besoin vous pouvez supprimer ddev en cas de conflits (ils ne devraient pas y en avoir si vous ne le démarrez pas)<br> 
=> à la racine du projet en bash: `rm -r .ddev`

