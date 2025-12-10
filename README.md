# 📋 Gestor de Tareas

Aplicación web para gestionar proyectos y tareas, conectada a una API REST de Laravel.

## 🚀 Características

### Autenticación
- ✅ Registro de nuevos usuarios
- ✅ Inicio de sesión con email y contraseña
- ✅ Cierre de sesión seguro
- ✅ Persistencia de sesión con tokens (Laravel Sanctum)

### Gestión de Proyectos
- ✅ Crear proyectos con nombre, descripción y fecha límite
- ✅ Listar todos los proyectos del usuario
- ✅ Editar proyectos existentes
- ✅ Eliminar proyectos
- ✅ Ver detalles completos de cada proyecto

### Gestión de Tareas
- ✅ Crear tareas dentro de un proyecto
- ✅ Editar tareas existentes
- ✅ Marcar tareas como completadas/pendientes
- ✅ Eliminar tareas
- ✅ Visualización diferenciada de tareas completadas

## 🛠️ Tecnologías Utilizadas

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: Laravel 10+ con API REST
- **Autenticación**: Laravel Sanctum
- **Base de datos**: MySQL/PostgreSQL (según configuración de Laravel)

## 📋 Requisitos Previos

- Navegador web moderno (Chrome, Firefox, Safari, Edge)
- API de Laravel corriendo en `http://127.0.0.1:8000`
- Configuración CORS habilitada en Laravel

## 🔧 Instalación

### 1. Configurar la API (Backend)

Asegúrate de que tu API Laravel esté configurada correctamente:

```bash
# Instalar dependencias
composer install

# Configurar archivo .env
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Ejecutar migraciones
php artisan migrate

# Iniciar servidor
php artisan serve
```

### 2. Configurar CORS en Laravel

Edita `config/cors.php`:

```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
```

### 3. Configurar el Frontend

1. Descarga o copia el archivo `index.html`
2. Abre el archivo en tu navegador web
3. ¡Listo! La aplicación ya está funcionando

> **Nota**: No es necesario servidor web para el frontend. Puede abrirse directamente desde el sistema de archivos.

## 🎯 Uso de la Aplicación

### Registro e Inicio de Sesión

1. **Registro**:
   - Haz clic en "Registrarse"
   - Completa: Nombre, Email, Contraseña y Confirmación
   - Haz clic en "Registrarse"

2. **Inicio de Sesión**:
   - Ingresa tu Email y Contraseña
   - Haz clic en "Iniciar Sesión"

### Gestión de Proyectos

1. **Crear Proyecto**:
   - Haz clic en "+ Nuevo Proyecto"
   - Completa el nombre, descripción (opcional) y fecha límite (opcional)
   - Haz clic en "Guardar Proyecto"

2. **Editar Proyecto**:
   - Haz clic en "Editar" en la tarjeta del proyecto
   - Modifica los campos necesarios
   - Guarda los cambios

3. **Eliminar Proyecto**:
   - Haz clic en "Eliminar" en la tarjeta del proyecto
   - Confirma la eliminación

4. **Abrir Proyecto**:
   - Haz clic en "Abrir" para ver las tareas del proyecto

### Gestión de Tareas

1. **Crear Tarea**:
   - Dentro de un proyecto, haz clic en "+ Nueva Tarea"
   - Completa el título y descripción (opcional)
   - Haz clic en "Guardar Tarea"

2. **Completar Tarea**:
   - Haz clic en "✓ Completar" para marcar como completada
   - Haz clic en "↩️ Deshacer" para marcar como pendiente

3. **Editar Tarea**:
   - Haz clic en "Editar" en la tarea
   - Modifica los campos
   - Guarda los cambios

4. **Eliminar Tarea**:
   - Haz clic en "Eliminar"
   - Confirma la eliminación

## 🔌 API Endpoints

### Autenticación
- `POST /api/register` - Registro de usuario
- `POST /api/login` - Inicio de sesión
- `POST /api/logout` - Cierre de sesión (requiere autenticación)
- `GET /api/user` - Obtener usuario actual (requiere autenticación)

### Proyectos
- `GET /api/projects` - Listar proyectos
- `POST /api/projects` - Crear proyecto
- `GET /api/projects/{id}` - Obtener proyecto
- `PUT /api/projects/{id}` - Actualizar proyecto
- `DELETE /api/projects/{id}` - Eliminar proyecto

### Tareas
- `GET /api/projects/{projectId}/tasks` - Listar tareas de un proyecto
- `POST /api/projects/{projectId}/tasks` - Crear tarea
- `GET /api/projects/{projectId}/tasks/{taskId}` - Obtener tarea
- `PUT /api/projects/{projectId}/tasks/{taskId}` - Actualizar tarea
- `PATCH /api/projects/{projectId}/tasks/{taskId}/complete` - Marcar como completada/pendiente
- `DELETE /api/projects/{projectId}/tasks/{taskId}` - Eliminar tarea

## 📝 Formato de Datos

### Proyecto
```json
{
  "name": "Mi Proyecto",
  "description": "Descripción del proyecto",
  "deadline": "2024-12-31 23:59:59"
}
```

### Tarea
```json
{
  "title": "Mi Tarea",
  "description": "Descripción de la tarea"
}
```

## 🎨 Personalización

### Cambiar URL de la API

Edita la línea 285 en `index.html`:

```javascript
const API_URL = 'http://tu-api-url.com/api';
```

### Modificar Colores

Los colores principales están en las variables CSS (líneas 22-24):

```css
background-color: rgb
```

## ⚠️ Solución de Problemas

### Error de CORS
Si recibes errores de CORS, verifica:
1. Que Laravel tenga CORS habilitado
2. Que la URL de la API sea correcta
3. Que el backend esté corriendo

### No guarda el token
Si no persiste la sesión:
1. Verifica que tu navegador permita localStorage
2. Revisa la consola del navegador (F12) para errores
3. Asegúrate de que la API devuelva el token correctamente

### No carga los datos
Si no se muestran proyectos o tareas:
1. Verifica que estés autenticado
2. Revisa la consola del navegador para errores
3. Verifica que los endpoints de la API funcionen correctamente

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Si tienes problemas o preguntas:
- Revisa la documentación de Laravel Sanctum
- Verifica los logs de Laravel (`storage/logs/laravel.log`)
- Revisa la consola del navegador para errores JavaScript
