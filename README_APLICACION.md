# Gestor de Tareas - Aplicación Web

## 📋 Descripción

Esta es una aplicación web moderna para gestionar proyectos y tareas. Consume la API REST que fue creada y corregida anteriormente. La aplicación permite a los usuarios:

- **Registrarse e iniciar sesión**
- **Crear, editar y eliminar proyectos**
- **Gestionar tareas dentro de cada proyecto**
- **Marcar tareas como completadas**
- **Cerrar sesión de forma segura**

## 🚀 Características Principales

### 1. **Autenticación**
- Registro de nuevos usuarios
- Inicio de sesión con email y contraseña
- Cierre de sesión seguro
- Almacenamiento de token en localStorage

### 2. **Gestión de Proyectos**
- Crear nuevos proyectos con nombre, descripción y fecha límite
- Listar todos los proyectos del usuario
- Ver detalles de un proyecto específico
- Editar proyectos existentes
- Eliminar proyectos

### 3. **Gestión de Tareas**
- Crear tareas dentro de un proyecto
- Listar tareas de un proyecto
- Editar tareas existentes
- Marcar tareas como completadas/incompletas
- Eliminar tareas

### 4. **Interfaz de Usuario**
- Diseño moderno y responsivo
- Gradientes atractivos
- Modales para crear/editar proyectos y tareas
- Mensajes de éxito y error
- Interfaz intuitiva y fácil de usar

## 📦 Requisitos

- PHP 8.1 o superior
- Node.js y npm
- Composer
- La API REST ejecutándose en `http://127.0.0.1:8000`

## 🔧 Instalación

### 1. Instalar dependencias de Composer
```bash
cd /home/ubuntu/ApiGestorTareaWeb/ApiGestorTareaWeb
composer install
```

### 2. Instalar dependencias de Node.js
```bash
npm install
```

### 3. Configurar el archivo .env
```bash
cp .env.example .env
php artisan key:generate
```

El archivo `.env` ya tiene configurada la URL de la API:
```
VITE_API_URL=http://127.0.0.1:8000/api
```

### 4. Compilar los assets (opcional)
```bash
npm run build
```

## 🎯 Ejecución

### Opción 1: Servidor de desarrollo de Laravel
```bash
php artisan serve
```

La aplicación estará disponible en: `http://127.0.0.1:8000`

### Opción 2: Con Vite en modo desarrollo (para desarrollo)
En una terminal:
```bash
php artisan serve
```

En otra terminal:
```bash
npm run dev
```

## 🔌 Conexión con la API

La aplicación se conecta automáticamente a la API en `http://127.0.0.1:8000/api`.

**Asegúrate de que la API esté ejecutándose antes de iniciar la aplicación web:**
```bash
cd /home/ubuntu/ApiGestorTareas/ApiGestorTareas
php artisan serve
```

## 📝 Flujo de Uso

### 1. **Registro**
- Haz clic en "Registrarse"
- Completa el formulario con nombre, email y contraseña
- Haz clic en "Registrarse"

### 2. **Inicio de Sesión**
- Ingresa tu email y contraseña
- Haz clic en "Iniciar Sesión"

### 3. **Crear Proyecto**
- Haz clic en "+ Nuevo Proyecto"
- Completa el nombre, descripción y fecha límite (opcional)
- Haz clic en "Guardar Proyecto"

### 4. **Gestionar Tareas**
- Haz clic en "Abrir" en un proyecto
- Haz clic en "+ Nueva Tarea"
- Completa el título y descripción de la tarea
- Haz clic en "Guardar Tarea"

### 5. **Marcar Tarea como Completada**
- Haz clic en "✓ Completar" en una tarea
- La tarea se marcará como completada (con estilo diferente)
- Haz clic en "↩️ Deshacer" para desmarcarla

### 6. **Editar o Eliminar**
- Usa los botones "Editar" y "Eliminar" en proyectos y tareas

## 🎨 Estructura de Archivos

```
resources/
├── views/
│   └── app.blade.php          # Vista principal (HTML + CSS)
├── js/
│   ├── app.js                 # Lógica principal de la aplicación
│   └── api.js                 # Cliente API
└── css/
    └── app.css                # Estilos CSS
```

## 🔐 Seguridad

- Los tokens se almacenan en localStorage
- Se incluye el token en el encabezado `Authorization: Bearer {token}` en todas las peticiones
- Las contraseñas se envían cifradas a través de HTTPS (en producción)
- Las validaciones se realizan tanto en el frontend como en el backend

## 🐛 Solución de Problemas

### Error: "Unauthenticated"
- Verifica que hayas iniciado sesión correctamente
- Comprueba que el token se está enviando en el encabezado `Authorization`

### Error: "No se puede conectar a la API"
- Asegúrate de que la API esté ejecutándose en `http://127.0.0.1:8000`
- Verifica que la URL en `.env` sea correcta: `VITE_API_URL=http://127.0.0.1:8000/api`

### Error: "CORS"
- Esto significa que la API no permite peticiones desde el dominio de la aplicación web
- En la API, asegúrate de tener configurado CORS correctamente

## 📱 Responsividad

La aplicación es completamente responsiva y funciona en:
- Computadoras de escritorio
- Tablets
- Dispositivos móviles

## 🚀 Despliegue en Producción

Para desplegar en producción:

1. Compila los assets:
```bash
npm run build
```

2. Configura el servidor web para servir desde la carpeta `public/`

3. Actualiza el archivo `.env` con la URL de la API en producción

4. Ejecuta las migraciones de la base de datos (si es necesario)

## 📞 Soporte

Si encuentras problemas, verifica:
- Que la API esté ejecutándose correctamente
- Que el archivo `.env` esté configurado correctamente
- Que todos los puertos estén disponibles (8000 para la API, 5173 para Vite en desarrollo)

## ✅ Características Implementadas

- ✅ Autenticación completa (Registro, Login, Logout)
- ✅ CRUD de Proyectos
- ✅ CRUD de Tareas
- ✅ Toggle de estado de tareas
- ✅ Interfaz responsiva y moderna
- ✅ Manejo de errores
- ✅ Mensajes de éxito y error
- ✅ Almacenamiento seguro de tokens
- ✅ Validación de formularios

## 🎉 ¡Listo para Usar!

La aplicación web está completamente funcional y lista para ser utilizada. Simplemente ejecuta los servidores y comienza a gestionar tus proyectos y tareas.
