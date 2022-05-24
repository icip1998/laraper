<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">LARAPER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ (Route::is('dashboard') ? 'active' : '') }}" aria-current="page" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Route::is('users.index') ? 'active' : '') }}" href="/users">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Route::is('buku.index') ? 'active' : '') }}" href="/buku">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Route::is('kategori.index') ? 'active' : '') }}" href="/kategori">Kategori Buku</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcom back, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout <i class="bi bi-box-arrow-in-right"></i></button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login <i class="bi bi-box-arrow-in-right"></i></a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>