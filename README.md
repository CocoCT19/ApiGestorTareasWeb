# Documentación de la Aplicación Web: Gestor de Tareas

## Introducción

El proyecto **ApiGestorTareaWeb** es la aplicación *frontend* diseñada para consumir la **API RESTful Gestor de Tareas** previamente analizada. Esta aplicación está construida sobre el *framework* **Laravel** para el *backend* (principalmente para servir los archivos estáticos y la vista inicial) y utiliza **JavaScript Vanilla** con **Vite** para el *frontend* interactivo.

La aplicación implementa un flujo completo de autenticación y gestión de recursos (proyectos y tareas) al interactuar directamente con los *endpoints* de la API.

## 1. Información Técnica y Dependencias

| Característica | Detalle |
| :--- | :--- |
| **Backend** | Laravel (`^10.10`) |
| **Frontend** | JavaScript Vanilla |
| **Empaquetador** | Vite |
| **Manejo de Peticiones** | `fetch` API (implementado en `resources/js/api.js`) |
| **Autenticación** | Basada en Token (Laravel Sanctum) |
| **Dependencia de Peticiones** | `axios` (listado en `package.json`, aunque el código usa `fetch`) |
| **Propósito** | Interfaz de Usuario para la Gestión de Proyectos y Tareas |

## 2. Configuración y Despliegue

La aplicación web requiere que la **API Gestor de Tareas** esté en funcionamiento para poder operar.

1.  **Clonar o Descomprimir el Proyecto:**
    Descomprima el archivo `ApiGestorTareaWeb.zip` en su entorno de desarrollo.

2.  **Instalar Dependencias de PHP:**
    Navegue hasta el directorio raíz del proyecto (`/home/ubuntu/ApiGestorTareaWeb/ApiGestorTareaWeb`) y ejecute:
    ```bash
    composer install
    ```

3.  **Instalar Dependencias de JavaScript:**
    Instale las dependencias de *frontend* (Vite, Axios, etc.):
    ```bash
    npm install
    # o
    pnpm install
    ```

4.  **Configuración del Entorno:**
    Cree el archivo de configuración `.env` a partir del ejemplo:
    ```bash
    cp .env.example .env
    ```

5.  **Configuración de la URL de la API:**
    La aplicación web se conecta a la API a través de una variable de entorno. Edite el archivo `.env` y asegúrese de que la variable `VITE_API_URL` apunte a la URL base de su API (donde se ejecuta el proyecto `ApiGestorTareas`).

    **Ejemplo de configuración en `.env`:**
    ```dotenv
    # ... otras variables de Laravel ...
    
    # URL base de la API Gestor de Tareas (sin el /api)
    VITE_API_URL="http://127.0.0.1:8000/api" 
    ```
    *Nota: Si la API se ejecuta en el mismo servidor y puerto que la web, puede omitir esta variable, pero se recomienda especificarla para claridad.*

6.  **Compilar Assets de Frontend:**
    Compile los archivos JavaScript y CSS usando Vite:
    ```bash
    npm run build
    ```
    Para desarrollo, puede usar:
    ```bash
    npm run dev
    ```

7.  **Iniciar el Servidor:**
    Inicie el servidor de Laravel para servir la aplicación web:
    ```bash
    php artisan serve
    ```
    La aplicación web estará disponible en `http://127.0.0.1:8000/`.

## 3. Interacción con la API

La lógica de interacción con la API se encuentra centralizada en los archivos JavaScript, principalmente en `resources/js/api.js` y `resources/js/app.js`.

### 3.1. Cliente de API (`resources/js/api.js`)

Este archivo define la clase `ApiClient`, que es responsable de:
*   Manejar la **URL base** de la API.
*   Almacenar y adjuntar el **Token de Autenticación** (`Authorization: Bearer <token>`) a todas las peticiones protegidas.
*   Implementar métodos genéricos (`get`, `post`, `put`, `patch`, `delete`) utilizando la **Fetch API** de JavaScript.
*   Manejar errores de respuesta HTTP.

### 3.2. Flujo de Autenticación y Gestión de Estado (`resources/js/app.js`)

El archivo principal de la aplicación gestiona el flujo de usuario:

| Funcionalidad | Método(s) de la Web | Endpoint de la API Consumido |
| :--- | :--- | :--- |
| **Inicialización** | `initApp()`, `checkAuth()` | `GET /user` |
| **Inicio de Sesión** | `handleLogin(event)` | `POST /login` |
| **Registro** | `handleRegister(event)` | `POST /register` |
| **Cierre de Sesión** | `logout()` | `POST /logout` |
| **Carga de Proyectos** | `loadProjects()` | `GET /projects` |
| **Crear/Editar Proyecto** | `handleSaveProject(event)` | `POST /projects` o `PUT /projects/{id}` |
| **Eliminar Proyecto** | `deleteProject(id)` | `DELETE /projects/{id}` |
| **Carga de Tareas** | `loadTasks(projectId)` | `GET /projects/{projectId}/tasks` |
| **Crear/Editar Tarea** | `handleSaveTask(event)` | `POST /projects/{projectId}/tasks` o `PUT /projects/{projectId}/tasks/{taskId}` |
| **Completar Tarea** | `toggleTask(taskId)` | `PATCH /projects/{projectId}/tasks/{taskId}/complete` |
| **Eliminar Tarea** | `deleteTask(taskId)` | `DELETE /projects/{projectId}/tasks/{taskId}` |

### 3.3. Manejo del Token

La aplicación web almacena el *token* de autenticación en el **`localStorage`** del navegador bajo la clave `'token'`.

*   **Almacenamiento:** Después de un `login` o `register` exitoso, el token se guarda.
*   **Recuperación:** En cada carga de la aplicación (`checkAuth`), se intenta recuperar el token para establecer la sesión.
*   **Eliminación:** En el `logout`, el token se elimina del `localStorage`.
