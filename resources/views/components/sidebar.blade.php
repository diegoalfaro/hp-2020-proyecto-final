<nav class="sidebar d-flex flex-column flex-shrink-0 bg-light shadow-lg h-100">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        @foreach ($items as $item)
            <li class="nav-item">
                <a
                    href="{{ $item->href }}"
                    @class([
                        "nav-link",
                        "active" => $item->active,
                        "py-3",
                        "border-bottom"
                    ])
                    aria-current="page"
                    title="{{ $item->title }}"
                    data-bs-toggle="tooltip"
                    data-bs-placement="right"
                >
                    <i class="icon" data-feather="{{ $item->icon }}"></i>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ $avatarSrc }}" alt="mdo" width="24" height="24" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>