# Webte final backend
## Installation

First clone this repo and cd into it.
```bash
git clone https://github.com/MarekHir/WebTe_2_final

cd WebTe_2_final

```
Then install composer dependencies and create sail alias.
```bash
docker run --rm --interactive --tty --volume $PWD:/app composer install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Then create .env file and edit it.
```bash
cp .env.example .env
```

Then run sail and generate key, migrate, seed database and create storage link.
```bash
sail build

sail up

sail artisan key:generate

sail artisan migrate

sail artisan db:seed

sail artisan storage:link
```

Now your app should be ready to use.
## Usage
```bash
sail up
```
