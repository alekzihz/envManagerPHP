# ⚙️ PHP .env Configurator

Una utilidad sencilla en PHP para cargar variables de entorno desde un archivo `.env` y definirlas como constantes o con `putenv()` para tu proyecto.

---

## 📌 Requisitos

- 🐘 **PHP >= 8.1**
- 📄 Archivo `.env` con formato `clave=valor`

---

## 📂 Estructura del proyecto

/mi-proyecto\
│\
├── config.php  
├── .env \
└── index.php \

---

## 🤔 Ejemplo de `.env`

```ini
# Modo online (true/false)
ONLINE=true

# Base de datos (desarrollo)
DB_USER=dev_user
DB_PASS=dev_pass
DB_NAME=my_database

# Base de datos (producción)
DB_USER_PRO=prod_user
DB_PASS_PRO=prod_pass

# Carpeta del proyecto
FOLDER_NAME=miProyecto
FOLDER_NAME_PRO=miProyecto.com

# Idiomas
IDIOMES_WEB=es,en
IDIOMES_WEB_ADMIN=es,en

# CAPTCHA
CAPTCHA_SITEKEY=sitekey_dev
CAPTCHA_SECRET=secret_dev
CAPTCHA_SITEKEY_PRO=sitekey_prod
CAPTCHA_SECRET_PRO=secret_prod

# API externa
URL_ANUNZIA_OPENAI=http://localhost/api/openai

# Email de envío
FROM_MAIL=info@ejemplo.com
```

## 🚀 ¿Cómo usarlo?

### 1. Incluye el `config.php`

```php
require_once __DIR__ . '/config.php';
```

### 2. Accede a tus constantes

```php
require_once __DIR__ . '/config.php';
echo DB_USER;
echo SITEKEY;
echo DOMINIO;
```

### 🔒 Seguridad

#### ❗ Nunca subas tu archivo .env a un repositorio público.

#### Asegúrate de tener esto en tu .gitignore:

```bash
.env
```

### 🧾 Licencia

MIT License – libre para usar, modificar y compartir.
