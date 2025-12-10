<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0d101bff 0%, #271935ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .navbar {
            background: #343c63ff;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }


        .content {
            padding: 30px;
            min-height: 500px;
        }

        .auth-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .btn {
            background-color: #002fffff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

       

        .btn-small {
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-danger {
            background-color : #ff0000ff;
        }

        .btn-success {
             background-color : #000000ff;
        }

        .form-toggle {
            text-align: center;
            margin-top: 20px;
        }

        .form-toggle a {
            color: #343c63ff;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

    

        .projects-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .project-card {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

     

        .project-card h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .project-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .project-actions {
            display: flex;
            gap: 10px;
        }

        .project-actions button {
            flex: 1;
            padding: 8px;
            font-size: 12px;
        }

        .tasks-container {
            margin-top: 20px;
        }

        .task-item {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-item.completed {
            border-left-color: #4facfe;
            opacity: 0.7;
        }

        .task-item.completed .task-title {
            text-decoration: line-through;
            color: #999;
        }

        .task-info {
            flex: 1;
        }

        .task-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .task-description {
            color: #666;
            font-size: 13px;
        }

        .task-actions {
            display: flex;
            gap: 10px;
        }

        .task-actions button {
            padding: 6px 12px;
            font-size: 12px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
        }



        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .hidden {
            display: none;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        @media (max-width: 768px) {
            .projects-container {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .navbar h1 {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h1> Gestor de Tareas</h1>
            <div id="userInfo" class="hidden">
                <span id="userName" style="margin-right: 20px;"></span>
                <button onclick="logout()">Cerrar Sesión</button>
            </div>
        </div>

        <div class="content">
            <!-- Auth Forms -->
            <div id="authSection">
                <div id="loginForm" class="auth-form">
                    <h2>Iniciar Sesión</h2>
                    <div id="loginError" class="error hidden"></div>
                    <form onsubmit="handleLogin(event)">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="loginEmail" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" id="loginPassword" required>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Iniciar Sesión</button>
                    </form>
                    <div class="form-toggle">
                        ¿No tienes cuenta? <a onclick="toggleForms()">Registrarse</a>
                    </div>
                </div>

                <div id="registerForm" class="auth-form hidden">
                    <h2>Registrarse</h2>
                    <div id="registerError" class="error hidden"></div>
                    <form onsubmit="handleRegister(event)">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" id="registerName" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="registerEmail" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" id="registerPassword" required>
                        </div>
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input type="password" id="registerPasswordConfirm" required>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Registrarse</button>
                    </form>
                    <div class="form-toggle">
                        ¿Ya tienes cuenta? <a onclick="toggleForms()">Iniciar Sesión</a>
                    </div>
                </div>
            </div>

            <!-- Main App -->
            <div id="appSection" class="hidden">
                <div id="successMessage" class="success hidden"></div>
                <div id="errorMessage" class="error hidden"></div>

                <!-- Projects Section -->
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h2>Mis Proyectos</h2>
                        <button class="btn" onclick="openProjectModal()">+ Nuevo Proyecto</button>
                    </div>

                    <div id="projectsList" class="projects-container"></div>
                </div>

                <!-- Project Detail Section -->
                <div id="projectDetail" class="hidden" style="margin-top: 40px; padding-top: 40px; border-top: 2px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h2 id="projectTitle"></h2>
                        <button class="btn btn-danger" onclick="closeProjectDetail()">← Volver</button>
                    </div>

                    <p id="projectDescription" style="color: #666; margin-bottom: 20px;"></p>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3>Tareas</h3>
                        <button class="btn btn-success" onclick="openTaskModal()">+ Nueva Tarea</button>
                    </div>

                    <div id="tasksList" class="tasks-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="projectModalTitle">Nuevo Proyecto</h2>
                <button class="close-btn" onclick="closeProjectModal()">&times;</button>
            </div>
            <form onsubmit="handleSaveProject(event)">
                <div class="form-group">
                    <label>Nombre del Proyecto</label>
                    <input type="text" id="projectName" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea id="projectDescriptionInput" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Fecha Límite (Opcional)</label>
                    <input type="datetime-local" id="projectDeadline">
                </div>
                <button type="submit" class="btn" style="width: 100%;">Guardar Proyecto</button>
            </form>
        </div>
    </div>

    <!-- Task Modal -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="taskModalTitle">Nueva Tarea</h2>
                <button class="close-btn" onclick="closeTaskModal()">&times;</button>
            </div>
            <form onsubmit="handleSaveTask(event)">
                <div class="form-group">
                    <label>Título de la Tarea</label>
                    <input type="text" id="taskTitle" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea id="taskDescription" rows="4"></textarea>
                </div>
                <button type="submit" class="btn" style="width: 100%;">Guardar Tarea</button>
            </form>
        </div>
    </div>

    <script>
        // API Configuration
        const API_URL = 'http://127.0.0.1:8000/api';
        let token = null;
        let currentProjectId = null;
        let currentEditingProjectId = null;
        let currentEditingTaskId = null;

        // API Client
        async function apiRequest(method, endpoint, data = null) {
            const url = `${API_URL}${endpoint}`;
            const options = {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            };

            if (token) {
                options.headers['Authorization'] = `Bearer ${token}`;
            }

            if (data) {
                options.body = JSON.stringify(data);
            }

            try {
                const response = await fetch(url, options);
                const responseData = await response.json();

                if (!response.ok) {
                    throw new Error(
                        responseData.message || 
                        responseData.error || 
                        `Error: ${response.status}`
                    );
                }

                return responseData;
            } catch (error) {
                throw error;
            }
        }

        // Initialize app
        function initApp() {
            checkAuth();
            setupEventListeners();
        }

        // Setup event listeners
        function setupEventListeners() {
            document.getElementById('projectModal').addEventListener('click', (e) => {
                if (e.target.id === 'projectModal') closeProjectModal();
            });

            document.getElementById('taskModal').addEventListener('click', (e) => {
                if (e.target.id === 'taskModal') closeTaskModal();
            });
        }

        // Check authentication
        async function checkAuth() {
            const storedToken = localStorage.getItem('token');

            if (storedToken) {
                token = storedToken;
                try {
                    const response = await apiRequest('GET', '/user');
                    showApp(response.user || response);
                    loadProjects();
                } catch (error) {
                    logout();
                }
            } else {
                showAuth();
            }
        }

        // Show auth section
        function showAuth() {
            document.getElementById('authSection').classList.remove('hidden');
            document.getElementById('appSection').classList.add('hidden');
            document.getElementById('userInfo').classList.add('hidden');
        }

        // Show app section
        function showApp(user) {
            document.getElementById('authSection').classList.add('hidden');
            document.getElementById('appSection').classList.remove('hidden');
            document.getElementById('userInfo').classList.remove('hidden');
            document.getElementById('userName').textContent = `Bienvenido, ${user.name}`;
        }

        // Toggle forms
        function toggleForms() {
            document.getElementById('loginForm').classList.toggle('hidden');
            document.getElementById('registerForm').classList.toggle('hidden');
            document.getElementById('loginError').classList.add('hidden');
            document.getElementById('registerError').classList.add('hidden');
        }

        // Handle login
        async function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const errorDiv = document.getElementById('loginError');

            try {
                const response = await apiRequest('POST', '/login', { email, password });
                token = response.token;
                localStorage.setItem('token', token);
                showApp(response.user);
                loadProjects();
            } catch (error) {
                errorDiv.textContent = error.message || 'Error al iniciar sesión';
                errorDiv.classList.remove('hidden');
            }
        }

        // Handle register
        async function handleRegister(event) {
            event.preventDefault();

            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const passwordConfirm = document.getElementById('registerPasswordConfirm').value;
            const errorDiv = document.getElementById('registerError');

            if (password !== passwordConfirm) {
                errorDiv.textContent = 'Las contraseñas no coinciden';
                errorDiv.classList.remove('hidden');
                return;
            }

            try {
                const response = await apiRequest('POST', '/register', {
                    name,
                    email,
                    password,
                    password_confirmation: passwordConfirm
                });
                token = response.token;
                localStorage.setItem('token', token);
                showApp(response.user);
                loadProjects();
            } catch (error) {
                errorDiv.textContent = error.message || 'Error al registrarse';
                errorDiv.classList.remove('hidden');
            }
        }

        // Logout
        async function logout() {
            try {
                await apiRequest('POST', '/logout', {});
            } catch (error) {
                console.error('Error during logout:', error);
            }
            localStorage.removeItem('token');
            token = null;
            showAuth();
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginEmail').value = '';
            document.getElementById('loginPassword').value = '';
        }

        // Load projects
        async function loadProjects() {
            try {
                const response = await apiRequest('GET', '/projects');
                const projects = response.data || response;
                displayProjects(projects);
            } catch (error) {
                showError('Error al cargar proyectos: ' + error.message);
            }
        }

        // Display projects
        function displayProjects(projects) {
            const container = document.getElementById('projectsList');

            if (projects.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>No hay proyectos. ¡Crea uno para comenzar!</p></div>';
                return;
            }

            container.innerHTML = projects.map(project => `
                <div class="project-card">
                    <h3>${escapeHtml(project.name)}</h3>
                    <p>${escapeHtml(project.description || 'Sin descripción')}</p>
                    ${project.deadline ? `<p><small>Vencimiento: ${project.deadline}</small></p>` : ''}
                    <div class="project-actions">
                        <button class="btn btn-success btn-small" onclick="openProject(${project.id})">Abrir</button>
                        <button class="btn btn-small" onclick="editProject(${project.id})">Editar</button>
                        <button class="btn btn-danger btn-small" onclick="deleteProject(${project.id})">Eliminar</button>
                    </div>
                </div>
            `).join('');
        }

        // Open project
        async function openProject(projectId) {
            currentProjectId = projectId;
            try {
                const response = await apiRequest('GET', `/projects/${projectId}`);
                const project = response.data || response;

                document.getElementById('projectTitle').textContent = project.name;
                document.getElementById('projectDescription').textContent = project.description || 'Sin descripción';
                document.getElementById('projectDetail').classList.remove('hidden');

                loadTasks(projectId);
            } catch (error) {
                showError('Error al cargar proyecto: ' + error.message);
            }
        }

        // Close project detail
        function closeProjectDetail() {
            currentProjectId = null;
            document.getElementById('projectDetail').classList.add('hidden');
            loadProjects();
        }

        // Load tasks
        async function loadTasks(projectId) {
            try {
                const response = await apiRequest('GET', `/projects/${projectId}/tasks`);
                const tasks = response.data || response;
                displayTasks(tasks);
            } catch (error) {
                showError('Error al cargar tareas: ' + error.message);
            }
        }

        // Display tasks
        function displayTasks(tasks) {
            const container = document.getElementById('tasksList');

            if (tasks.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>No hay tareas en este proyecto.</p></div>';
                return;
            }

            container.innerHTML = tasks.map(task => `
                <div class="task-item ${task.completed ? 'completed' : ''}">
                    <div class="task-info">
                        <div class="task-title">${escapeHtml(task.title)}</div>
                        ${task.description ? `<div class="task-description">${escapeHtml(task.description)}</div>` : ''}
                    </div>
                    <div class="task-actions">
                        <button class="btn btn-success btn-small" onclick="toggleTask(${task.id})">${task.completed ? '↩️ Deshacer' : '✓ Completar'}</button>
                        <button class="btn btn-small" onclick="editTask(${task.id})">Editar</button>
                        <button class="btn btn-danger btn-small" onclick="deleteTask(${task.id})">Eliminar</button>
                    </div>
                </div>
            `).join('');
        }

        // Open project modal
        function openProjectModal() {
            currentEditingProjectId = null;
            document.getElementById('projectModalTitle').textContent = 'Nuevo Proyecto';
            document.getElementById('projectName').value = '';
            document.getElementById('projectDescriptionInput').value = '';
            document.getElementById('projectDeadline').value = '';
            document.getElementById('projectModal').classList.add('active');
        }

        // Close project modal
        function closeProjectModal() {
            document.getElementById('projectModal').classList.remove('active');
        }

        // Handle save project
        async function handleSaveProject(event) {
            event.preventDefault();

            const name = document.getElementById('projectName').value;
            const description = document.getElementById('projectDescriptionInput').value;
            const deadline = document.getElementById('projectDeadline').value;

            // Convert datetime-local to Y-m-d H:i:s format
            let formattedDeadline = null;
            if (deadline) {
                const date = new Date(deadline);
                formattedDeadline = date.getFullYear() + '-' + 
                    String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(date.getDate()).padStart(2, '0') + ' ' + 
                    String(date.getHours()).padStart(2, '0') + ':' + 
                    String(date.getMinutes()).padStart(2, '0') + ':' + 
                    String(date.getSeconds()).padStart(2, '0');
            }

            try {
                if (currentEditingProjectId) {
                    await apiRequest('PUT', `/projects/${currentEditingProjectId}`, {
                        name,
                        description,
                        deadline: formattedDeadline
                    });
                    showSuccess('Proyecto actualizado correctamente');
                } else {
                    await apiRequest('POST', '/projects', {
                        name,
                        description,
                        deadline: formattedDeadline
                    });
                    showSuccess('Proyecto creado correctamente');
                }

                closeProjectModal();
                loadProjects();
            } catch (error) {
                showError('Error al guardar proyecto: ' + error.message);
            }
        }

        // Edit project
        async function editProject(projectId) {
            try {
                const response = await apiRequest('GET', `/projects/${projectId}`);
                const project = response.data || response;

                currentEditingProjectId = projectId;
                document.getElementById('projectModalTitle').textContent = 'Editar Proyecto';
                document.getElementById('projectName').value = project.name;
                document.getElementById('projectDescriptionInput').value = project.description || '';
                
                // Convert Y-m-d H:i:s to datetime-local format
                if (project.deadline) {
                    const date = new Date(project.deadline);
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const hours = String(date.getHours()).padStart(2, '0');
                    const minutes = String(date.getMinutes()).padStart(2, '0');
                    document.getElementById('projectDeadline').value = `${year}-${month}-${day}T${hours}:${minutes}`;
                } else {
                    document.getElementById('projectDeadline').value = '';
                }
                
                document.getElementById('projectModal').classList.add('active');
            } catch (error) {
                showError('Error al cargar proyecto: ' + error.message);
            }
        }

        // Delete project
        async function deleteProject(projectId) {
            if (!confirm('¿Estás seguro de que deseas eliminar este proyecto?')) return;

            try {
                await apiRequest('DELETE', `/projects/${projectId}`);
                showSuccess('Proyecto eliminado correctamente');
                if (currentProjectId === projectId) {
                    closeProjectDetail();
                } else {
                    loadProjects();
                }
            } catch (error) {
                showError('Error al eliminar proyecto: ' + error.message);
            }
        }

        // Open task modal
        function openTaskModal() {
            if (!currentProjectId) {
                showError('Debes seleccionar un proyecto primero');
                return;
            }

            currentEditingTaskId = null;
            document.getElementById('taskModalTitle').textContent = 'Nueva Tarea';
            document.getElementById('taskTitle').value = '';
            document.getElementById('taskDescription').value = '';
            document.getElementById('taskModal').classList.add('active');
        }

        // Close task modal
        function closeTaskModal() {
            document.getElementById('taskModal').classList.remove('active');
        }

        // Handle save task
        async function handleSaveTask(event) {
            event.preventDefault();

            const title = document.getElementById('taskTitle').value;
            const description = document.getElementById('taskDescription').value;

            try {
                if (currentEditingTaskId) {
                    await apiRequest('PUT', `/projects/${currentProjectId}/tasks/${currentEditingTaskId}`, {
                        title,
                        description
                    });
                    showSuccess('Tarea actualizada correctamente');
                } else {
                    await apiRequest('POST', `/projects/${currentProjectId}/tasks`, {
                        title,
                        description
                    });
                    showSuccess('Tarea creada correctamente');
                }

                closeTaskModal();
                loadTasks(currentProjectId);
            } catch (error) {
                showError('Error al guardar tarea: ' + error.message);
            }
        }

        // Edit task
        async function editTask(taskId) {
            try {
                const response = await apiRequest('GET', `/projects/${currentProjectId}/tasks/${taskId}`);
                const task = response.data || response;

                currentEditingTaskId = taskId;
                document.getElementById('taskModalTitle').textContent = 'Editar Tarea';
                document.getElementById('taskTitle').value = task.title;
                document.getElementById('taskDescription').value = task.description || '';
                document.getElementById('taskModal').classList.add('active');
            } catch (error) {
                showError('Error al cargar tarea: ' + error.message);
            }
        }

        // Toggle task
        async function toggleTask(taskId) {
            try {
                await apiRequest('PATCH', `/projects/${currentProjectId}/tasks/${taskId}/complete`, {});
                loadTasks(currentProjectId);
            } catch (error) {
                showError('Error al actualizar tarea: ' + error.message);
            }
        }

        // Delete task
        async function deleteTask(taskId) {
            if (!confirm('¿Estás seguro de que deseas eliminar esta tarea?')) return;

            try {
                await apiRequest('DELETE', `/projects/${currentProjectId}/tasks/${taskId}`);
                showSuccess('Tarea eliminada correctamente');
                loadTasks(currentProjectId);
            } catch (error) {
                showError('Error al eliminar tarea: ' + error.message);
            }
        }

        // Show success
        function showSuccess(message) {
            const div = document.getElementById('successMessage');
            div.textContent = message;
            div.classList.remove('hidden');
            setTimeout(() => {
                div.classList.add('hidden');
            }, 3000);
        }

        // Show error
        function showError(message) {
            const div = document.getElementById('errorMessage');
            div.textContent = message;
            div.classList.remove('hidden');
            setTimeout(() => {
                div.classList.add('hidden');
            }, 3000);
        }

        // Escape HTML
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Initialize on load
        initApp();
    </script>
</body>
</html><?php /**PATH C:\Users\Cococaina\Documents\ApiGestorTareaWeb\resources\views/app.blade.php ENDPATH**/ ?>