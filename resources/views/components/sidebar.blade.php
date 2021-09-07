<nav class="sidebar d-flex flex-column flex-shrink-0 bg-white shadow-lg h-100">

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
                    <icon name="{{ $item->icon }}">
                </a>
            </li>
        @endforeach
    </ul>
</nav>