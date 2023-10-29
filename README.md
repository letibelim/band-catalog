# Band Catalog Demo Project

A [Docker](https://www.docker.com/)-based stack for the Band Catalog,
with [FrankenPHP](https://frankenphp.dev) and [Caddy](https://caddyserver.com/) More than inspired by 
Kevin Dunglas [Symfony Docker stack](https://github.com/dunglas/symfony-docker).

## Run the Demo

### Backend Part

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. add a .env.local file at the root fot the project with the following content:
```shell
APP_ENV=dev
APP_SECRET=92f5b8070562fd26205b65b9c3f4a5fc # Or any high entropy secret...
DATABASE_URL="postgresql://postgres:postgres@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'

```
3. Run `docker compose build --no-cache` to build fresh images
4. Run `docker compose up --pull -d --wait` to start the project
5. Open `https://localhost/api` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Run `docker compose down --remove-orphans` to stop the Docker containers.

### Client Part (not dockerized)

1. Install the latest version of nodejs/npm. If you use nvm as a nodejs version manager, 
you can simply `cd client` and run `nvm use` as there is a .nvmrc file at the root of the client folder
2. install the Angular CLI: `npm install -g @angular/cli`
3. run `npm install` from within the `client` folder to install the dependencies
4. run `ng serve --open` to launch the client development server
5. Go visit `http://localhost:4200`
