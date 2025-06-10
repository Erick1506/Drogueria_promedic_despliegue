{{-- NAVBAR PRINCIPAL --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- Marca / Título --}}
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <h2 class="m-0">Promedic</h2>
        </a>

        {{-- Toggler general --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        {{-- Menú principal --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}"
                        href="{{ route('estadisticas.index') }}">Estadísticas</a>
                </li>

                {{-- Dropdown Productos --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('productos*') ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('promociones.index') }}">Promociones</a></li>
                        <li><a class="dropdown-item" href="{{ route('productos.create') }}">Agregar Producto</a></li>
                    </ul>
                </li>

                {{-- Dropdown Fórmulas --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('recetas*') ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fórmulas médicas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('recetas.index') }}">Fórmulas registradas</a></li>
                    </ul>
                </li>
            </ul>

            <!-- API EXTERNA -->

            <!-- Icono de Lupa para abrir el modal -->
            <div class="text-end m-3">
                <i class="bi bi-search cursor-pointer" style="font-size: 1.5rem;" data-bs-toggle="modal"
                    data-bs-target="#searchModal" title="Buscar producto en DrugBank"></i>
            </div>

            <!-- Modal de búsqueda de productos -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Buscar producto en DrugBank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="productName" class="form-control"
                                placeholder="Ingrese el nombre del producto" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" id="searchProduct">Buscar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenedor para mostrar resultados (si decides mostrar algo luego) -->
            <div id="productResults" class="m-3"></div>



            {{-- Área de acciones: notificaciones, búsqueda, perfil --}}
            <div class="d-flex align-items-center">
                {{-- Notificaciones --}}

                <!-- Botón de Notificación -->
                <button type="button" class="btn btn-outline-primary position-relative" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bell" viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                    </svg>
                    <span id="notificationCount"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="display: none;">0</span>
                </button>

                <!-- Modal para mostrar notificaciones -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Notificaciones</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>

                            <div class="modal-body" id="notificationBody">
                                <p>Cargando notificaciones...</p>
                            </div>
                            <div class="modal-footer">
                                <input type="text" id="newNotification" class="form-control"
                                    placeholder="Escribe una notificación" />
                                <button type="button" class="btn btn-light" id="addNotification">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
    <script src="{{ asset('build/assets/js/notifications.js') }}"></script>


                {{-- Búsqueda --}}
                <form class="d-flex mx-2" id="searchForm" onsubmit="return false;">
                    <input class="form-control me-2" type="search" placeholder="Buscar por ID o nombre"
                        aria-label="Search" id="searchInput">
                    <button class="btn btn-custom" type="button" id="searchButton">Buscar</button>
                </form>

                {{-- Perfil --}}
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownProfileButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person fs-5"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfileButton">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                            </form>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('regentes.index') }}">Gestión de regente</a></li>
                        <li><a class="dropdown-item" href="{{ route('proveedores.index') }}">Gestión de proveedor</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>



{{-- MODAL: Notificaciones --}}
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">Notificaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="notificationBody">
                <p>Cargando notificaciones...</p>
            </div>
            <div class="modal-footer">
                <input type="text" id="newNotification" class="form-control" placeholder="Escribe una notificación">

                <button type="button" class="btn btn-light" id="addNotification">Agregar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-light" id="goToDetailsBtn">Ir a detalles</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('build/assets/js/apiExterna.js') }}"></script>