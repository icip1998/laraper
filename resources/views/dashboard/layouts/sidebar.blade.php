<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            @can('isAdmin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">
                        <span data-feather="file"></span>
                        Pengguna
                    </a>
                </li>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Kelola Buku</span>
                    <a class="link-secondary" href="#" aria-label="Kelola Buku">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kategori*') ? 'active' : '' }}" href="/kategori">
                        <span data-feather="file"></span>
                        Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penerbit*') ? 'active' : '' }}" href="/penerbit">
                        <span data-feather="file"></span>
                        Penerbit
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link {{ Request::is('buku*') ? 'active' : '' }}" href="/buku">
                    <span data-feather="file"></span>
                    Buku
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Transaksi</span>
                <a class="link-secondary" href="#" aria-label="Kelola">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}" href="/pinjam">
                    <span data-feather="file"></span>
                    Peminjaman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('kembali*') ? 'active' : '' }}" href="/kembali">
                    <span data-feather="file"></span>
                    Pengembalian
                </a>
            </li>
        </ul>
    </div>
</nav>