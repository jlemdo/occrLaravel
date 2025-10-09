# 🚀 Guía de Deployment Automático con GitHub Actions

Este proyecto usa **GitHub Actions** para hacer deployment automático a AWS cada vez que haces `git push` a la rama `master`.

## 📋 Requisitos Previos

1. ✅ Servidor AWS (EC2 o Lightsail) configurado
2. ✅ Git instalado en el servidor
3. ✅ Composer instalado en el servidor
4. ✅ PHP 8.2+ instalado
5. ✅ MySQL/MariaDB configurado
6. ✅ Acceso SSH al servidor

---

## 🔑 Paso 1: Configurar Secrets en GitHub

Ve a tu repositorio en GitHub:
```
Settings → Secrets and variables → Actions → New repository secret
```

### Agrega estos secrets:

#### 1. **AWS_HOST**
- Valor: La IP o dominio de tu servidor AWS
- Ejemplo: `123.45.67.89` o `occr.pixelcrafters.digital`

#### 2. **AWS_USERNAME**
- Valor: Usuario SSH (normalmente `ubuntu` para Ubuntu o `ec2-user` para Amazon Linux)
- Ejemplo: `ubuntu`

#### 3. **AWS_SSH_KEY**
- Valor: Tu llave SSH privada completa (el contenido del archivo `.pem`)
- Cómo obtenerla:
  ```bash
  # En Windows (PowerShell):
  Get-Content C:\path\to\your-key.pem

  # Copiar TODO el contenido, incluyendo:
  # -----BEGIN RSA PRIVATE KEY-----
  # ... contenido ...
  # -----END RSA PRIVATE KEY-----
  ```

#### 4. **AWS_PORT** (opcional)
- Valor: Puerto SSH (por defecto es `22`)
- Solo agregar si usas un puerto diferente

---

## 🛠️ Paso 2: Preparar el Servidor AWS

### 2.1 Conectarse al servidor
```bash
ssh -i your-key.pem ubuntu@your-server-ip
```

### 2.2 Instalar dependencias
```bash
# Actualizar sistema
sudo apt update && sudo apt upgrade -y

# Instalar Git
sudo apt install git -y

# Instalar PHP 8.2
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip -y

# Instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Instalar Nginx
sudo apt install nginx -y

# Instalar MySQL
sudo apt install mysql-server -y
```

### 2.3 Clonar el repositorio
```bash
# Crear directorio
sudo mkdir -p /var/www/html
cd /var/www/html

# Clonar repo (sustituye con tu URL de GitHub)
sudo git clone https://github.com/tu-usuario/tu-repo.git foodbackend

# Dar permisos
sudo chown -R www-data:www-data /var/www/html/foodbackend
sudo chmod -R 775 /var/www/html/foodbackend/storage
sudo chmod -R 775 /var/www/html/foodbackend/bootstrap/cache
```

### 2.4 Configurar .env en el servidor
```bash
cd /var/www/html/foodbackend
sudo cp .env.example .env
sudo nano .env
```

Actualizar estas variables:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://occr.pixelcrafters.digital

DB_HOST=localhost
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 2.5 Generar key de Laravel
```bash
php artisan key:generate
```

### 2.6 Configurar Nginx
```bash
sudo nano /etc/nginx/sites-available/foodbackend
```

Pegar esta configuración:
```nginx
server {
    listen 80;
    server_name occr.pixelcrafters.digital;
    root /var/www/html/foodbackend/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Activar el sitio:
```bash
sudo ln -s /etc/nginx/sites-available/foodbackend /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 2.7 Configurar SSL con Let's Encrypt (opcional pero recomendado)
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d occr.pixelcrafters.digital
```

### 2.8 Configurar Git para deployment
```bash
cd /var/www/html/foodbackend

# Configurar Git para permitir pull automático
git config --global --add safe.directory /var/www/html/foodbackend

# Asegurar que está en la rama master
git checkout master
```

---

## 🎯 Paso 3: ¡Hacer Deployment!

Una vez configurado todo, el deployment es **AUTOMÁTICO**:

### Opción 1: Push automático
```bash
git add .
git commit -m "feat: Nueva funcionalidad"
git push origin master
```

✅ GitHub Actions detectará el push y desplegará automáticamente!

### Opción 2: Deployment manual desde GitHub
1. Ve a tu repo → **Actions**
2. Selecciona **Deploy to AWS**
3. Click en **Run workflow**
4. Click **Run workflow** (botón verde)

---

## 📊 Monitorear el Deployment

1. Ve a tu repositorio en GitHub
2. Click en **Actions** (pestaña superior)
3. Verás el workflow ejecutándose en tiempo real
4. Click en el workflow para ver logs detallados

**Estados posibles:**
- 🟡 **Amarillo (running)**: Deployment en progreso
- ✅ **Verde (success)**: Deployment exitoso
- ❌ **Rojo (failed)**: Deployment falló (revisa logs)

---

## 🐛 Troubleshooting

### Error: "Permission denied (publickey)"
**Solución:** Verifica que el secret `AWS_SSH_KEY` tenga la llave privada completa

### Error: "Git pull failed"
**Solución:** En el servidor:
```bash
cd /var/www/html/foodbackend
sudo git reset --hard origin/master
sudo git pull origin master
```

### Error: "Permission denied" al escribir archivos
**Solución:**
```bash
sudo chown -R www-data:www-data /var/www/html/foodbackend
sudo chmod -R 775 /var/www/html/foodbackend/storage
sudo chmod -R 775 /var/www/html/foodbackend/bootstrap/cache
```

### Error: Migraciones no se ejecutan
**Solución:** Ejecutar manualmente en el servidor:
```bash
cd /var/www/html/foodbackend
php artisan migrate --force
```

---

## 🔒 Seguridad

**IMPORTANTE:** Nunca subas estos archivos a GitHub:
- ✅ `.env` (ya está en .gitignore)
- ✅ Llaves SSH privadas
- ✅ Credenciales de AWS
- ✅ Claves de Stripe/Firebase

Todos los secrets deben estar en **GitHub Secrets**, NO en el código.

---

## 📝 Flujo de Trabajo Completo

```
1. Desarrollas en local
2. git add . && git commit -m "mensaje"
3. git push origin master
4. 🤖 GitHub Actions se activa automáticamente
5. ✅ Código se despliega a AWS
6. 🗄️ Migraciones se ejecutan
7. 🧹 Caché se limpia
8. ✅ Aplicación lista en producción!
```

---

## 🎉 ¡Listo!

Ahora tienes **Continuous Deployment (CD)** configurado. Cada vez que hagas push a `master`, tu código se desplegará automáticamente a AWS.

**¿Preguntas?** Revisa los logs en GitHub Actions o contacta al equipo de desarrollo.
