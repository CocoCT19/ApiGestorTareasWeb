import { ApiClient } from './api.js';

const API_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
let api = new ApiClient(API_URL);
let currentProjectId = null;
let currentEditingProjectId = null;
let currentEditingTaskId = null;

// Initialize app
export function initApp() {
    checkAuth();
    setupEventListeners();
}

// Setup event listeners
function setupEventListeners() {
    // Close modals when clicking outside
    document.getElementById('projectModal').addEventListener('click', (e) => {
        if (e.target.id === 'projectModal') closeProjectModal();
    });

    document.getElementById('taskModal').addEventListener('click', (e) => {
        if (e.target.id === 'taskModal') closeTaskModal();
    });
}

// Check authentication status
async function checkAuth() {
    const token = localStorage.getItem('token');

    if (token) {
        api.setToken(token);
        try {
            const response = await api.get('/user');
            showApp(response.user);
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

// Toggle between login and register forms
window.toggleForms = function() {
    document.getElementById('loginForm').classList.toggle('hidden');
    document.getElementById('registerForm').classList.toggle('hidden');
    document.getElementById('loginError').classList.add('hidden');
    document.getElementById('registerError').classList.add('hidden');
};

// Handle login
window.handleLogin = async function(event) {
    event.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const errorDiv = document.getElementById('loginError');

    try {
        const response = await api.post('/login', { email, password });
        localStorage.setItem('token', response.token);
        api.setToken(response.token);
        showApp(response.user);
        loadProjects();
    } catch (error) {
        errorDiv.textContent = error.message || 'Error al iniciar sesión';
        errorDiv.classList.remove('hidden');
    }
};

// Handle register
window.handleRegister = async function(event) {
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
        const response = await api.post('/register', {
            name,
            email,
            password,
            password_confirmation: passwordConfirm
        });
        localStorage.setItem('token', response.token);
        api.setToken(response.token);
        showApp(response.user);
        loadProjects();
    } catch (error) {
        errorDiv.textContent = error.message || 'Error al registrarse';
        errorDiv.classList.remove('hidden');
    }
};

// Logout
window.logout = async function() {
    try {
        await api.post('/logout', {});
    } catch (error) {
        console.error('Error during logout:', error);
    }
    localStorage.removeItem('token');
    api.setToken(null);
    showAuth();
    document.getElementById('loginForm').classList.remove('hidden');
    document.getElementById('registerForm').classList.add('hidden');
    document.getElementById('loginEmail').value = '';
    document.getElementById('loginPassword').value = '';
};

// Load projects
async function loadProjects() {
    try {
        const response = await api.get('/projects');
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

// Open project detail
window.openProject = async function(projectId) {
    currentProjectId = projectId;
    try {
        const response = await api.get(`/projects/${projectId}`);
        const project = response.data || response;

        document.getElementById('projectTitle').textContent = project.name;
        document.getElementById('projectDescription').textContent = project.description || 'Sin descripción';
        document.getElementById('projectDetail').classList.remove('hidden');

        loadTasks(projectId);
    } catch (error) {
        showError('Error al cargar proyecto: ' + error.message);
    }
};

// Close project detail
window.closeProjectDetail = function() {
    currentProjectId = null;
    document.getElementById('projectDetail').classList.add('hidden');
    loadProjects();
};

// Load tasks for a project
async function loadTasks(projectId) {
    try {
        const response = await api.get(`/projects/${projectId}/tasks`);
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
window.openProjectModal = function() {
    currentEditingProjectId = null;
    document.getElementById('projectName').value = '';
    document.getElementById('projectDescription').value = '';
    document.getElementById('projectDeadline').value = '';
    document.getElementById('projectModal').classList.add('active');
};

// Close project modal
window.closeProjectModal = function() {
    document.getElementById('projectModal').classList.remove('active');
};

// Handle save project
window.handleSaveProject = async function(event) {
    event.preventDefault();

    const name = document.getElementById('projectName').value;
    const description = document.getElementById('projectDescription').value;
    const deadline = document.getElementById('projectDeadline').value;

    try {
        if (currentEditingProjectId) {
            await api.put(`/projects/${currentEditingProjectId}`, {
                name,
                description,
                deadline: deadline || null
            });
            showSuccess('Proyecto actualizado correctamente');
        } else {
            await api.post('/projects', {
                name,
                description,
                deadline: deadline || null
            });
            showSuccess('Proyecto creado correctamente');
        }

        closeProjectModal();
        loadProjects();
    } catch (error) {
        showError('Error al guardar proyecto: ' + error.message);
    }
};

// Edit project
window.editProject = async function(projectId) {
    try {
        const response = await api.get(`/projects/${projectId}`);
        const project = response.data || response;

        currentEditingProjectId = projectId;
        document.getElementById('projectName').value = project.name;
        document.getElementById('projectDescription').value = project.description || '';
        document.getElementById('projectDeadline').value = project.deadline || '';
        document.getElementById('projectModal').classList.add('active');
    } catch (error) {
        showError('Error al cargar proyecto: ' + error.message);
    }
};

// Delete project
window.deleteProject = async function(projectId) {
    if (!confirm('¿Estás seguro de que deseas eliminar este proyecto?')) return;

    try {
        await api.delete(`/projects/${projectId}`);
        showSuccess('Proyecto eliminado correctamente');
        if (currentProjectId === projectId) {
            closeProjectDetail();
        } else {
            loadProjects();
        }
    } catch (error) {
        showError('Error al eliminar proyecto: ' + error.message);
    }
};

// Open task modal
window.openTaskModal = function() {
    if (!currentProjectId) {
        showError('Debes seleccionar un proyecto primero');
        return;
    }

    currentEditingTaskId = null;
    document.getElementById('taskTitle').value = '';
    document.getElementById('taskDescription').value = '';
    document.getElementById('taskModal').classList.add('active');
};

// Close task modal
window.closeTaskModal = function() {
    document.getElementById('taskModal').classList.remove('active');
};

// Handle save task
window.handleSaveTask = async function(event) {
    event.preventDefault();

    const title = document.getElementById('taskTitle').value;
    const description = document.getElementById('taskDescription').value;

    try {
        if (currentEditingTaskId) {
            await api.put(`/projects/${currentProjectId}/tasks/${currentEditingTaskId}`, {
                title,
                description
            });
            showSuccess('Tarea actualizada correctamente');
        } else {
            await api.post(`/projects/${currentProjectId}/tasks`, {
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
};

// Edit task
window.editTask = async function(taskId) {
    try {
        const response = await api.get(`/projects/${currentProjectId}/tasks/${taskId}`);
        const task = response.data || response;

        currentEditingTaskId = taskId;
        document.getElementById('taskTitle').value = task.title;
        document.getElementById('taskDescription').value = task.description || '';
        document.getElementById('taskModal').classList.add('active');
    } catch (error) {
        showError('Error al cargar tarea: ' + error.message);
    }
};

// Toggle task completion
window.toggleTask = async function(taskId) {
    try {
        await api.patch(`/projects/${currentProjectId}/tasks/${taskId}/complete`, {});
        loadTasks(currentProjectId);
    } catch (error) {
        showError('Error al actualizar tarea: ' + error.message);
    }
};

// Delete task
window.deleteTask = async function(taskId) {
    if (!confirm('¿Estás seguro de que deseas eliminar esta tarea?')) return;

    try {
        await api.delete(`/projects/${currentProjectId}/tasks/${taskId}`);
        showSuccess('Tarea eliminada correctamente');
        loadTasks(currentProjectId);
    } catch (error) {
        showError('Error al eliminar tarea: ' + error.message);
    }
};

// Show success message
function showSuccess(message) {
    const div = document.getElementById('successMessage');
    div.textContent = message;
    div.classList.remove('hidden');
    setTimeout(() => {
        div.classList.add('hidden');
    }, 3000);
}

// Show error message
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

// Make functions global
window.showSuccess = showSuccess;
window.showError = showError;
