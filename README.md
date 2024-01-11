
# Recetazas

¡Hola! Este es un blog de recetas hecho con Laravel. **En estos momentos, no cuenta con un despliegue disponible. Se irá actualizando...**



## Despliegue en local

Crea una nueva base de datos de MySQL o MariaDB que esté vacía. Laravel se encargará del resto

Clona el proyecto

```bash
  git clone https://link-to-project
```

Ve al directorio del proyecto

```bash
  cd my-project
```

Usa el fichero env.example como plantilla para un nuevo .env. Rellénalo con los datos de tu base de datos


Instala las dependencias

```bash
  npm install
```

Fuerza las migraciones y semillas

```bash
  php artisan migrate:refresh --seed
```

Si todo ha ido correctamente, podrás desplegarlo en el servidor local

```bash
  php artisan serve
```


## Roadmap

- Adición de nuevas semillas: más entradas de ejemplo

- Ajustes visuales

- Optimización del código

- Despliegue a producción


## Tech Stack

**Client:** Blade, Bootstrap 4, CSS

**Server:** Laravel, MySQL


