<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="{{ '/' }}" class="fw-bold">{{ config('app.name') }}</a>
            </div>
            <div class="header-top-right">
                @auth
                @php
                $user = auth()->user();
                @endphp
                <div class="dropdown">
                    <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ $user->avatar() }}" alt="Avatar">
                        </div>
                        <div class="text d-none d-xl-block">
                            <h6 class="user-dropdown-name">{{ $user->name }}</h6>
                            <p class="user-dropdown-status text-sm text-muted">{{ $user->role }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('account.index') }}">Akun Saya</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3" style="vertical-align: top"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul>
                @auth
                <li class="menu-item">
                    <a href="{{ route('home.index') }}" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dasbor</span>
                    </a>
                </li>
                @if (canAny(['read-incoming-letter', 'read-incoming-letter-category', 'read-incoming-letter-disposition']))
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Masuk</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if (can('read-incoming-letter'))
                                <li class="submenu-item">
                                    <a href="{{ route('incoming-letter.index') }}" class='submenu-link'>Surat
                                        Masuk</a>
                                </li>
                                @endif
                                @if (can('read-incoming-letter-disposition'))
                                <li class="submenu-item">
                                    <a href="{{ route('incoming-letter-disposition.index') }}" class='submenu-link'>Disposisi Surat Masuk</a>
                                </li>
                                @endif
                                @if (can('read-incoming-letter-category'))
                                <li class="submenu-item">
                                    <a href="{{ route('incoming-letter-category.index') }}" class='submenu-link'>Kategori Surat Masuk</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @if (canAny([
                'read-active-student-letter',
                'read-school-transfer-letter',
                'read-pindah-prodi',
                'read-sppd-letter',
                'read-leave-permit-letter',
                ]))
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Keluar</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if (can('read-active-student-letter'))
                                <li class="submenu-item">
                                    <a href="{{ route('active-student-letter.index') }}" class='submenu-link'>Surat
                                        Siswa Aktif</a>
                                </li>
                                @endif
                                @if (can('read-school-transfer-letter'))
                                <li class="submenu-item">
                                    <a href="{{ route('school-transfer-letter.index') }}" class='submenu-link'>Surat
                                        Pindah Sekolah</a>
                                </li>
                                @endif
                                @if (can('read-pindah-prodi'))
                                <li class="submenu-item">
                                    <a href="{{ route('pindah-prodi.index') }}" class='submenu-link'>Surat
                                        Pindah Prodi</a>
                                </li>
                                @endif
                                @if (can('read-sppd-letter'))
                                <li class="submenu-item">
                                    <a href="{{ route('sppd-letter.index') }}" class='submenu-link'>Surat
                                        Perjalanan Dinas</a>
                                </li>
                                @endif
                                @if (can('read-leave-permit-letter'))
                                <li class="submenu-item">
                                    <a href="{{ route('leave-permit-letter.index') }}" class='submenu-link'>Surat
                                        Izin
                                        Cuti</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                @endif

                @if (canAny(['read-school-document', 'read-student-certificate']))
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-archive-fill"></i>
                        <span>Arsip</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if (can('read-school-document'))
                                <li class="submenu-item">
                                    <a href="{{ route('school-document.index') }}" class='submenu-link'>Dokumen
                                        Universitas</a>
                                </li>
                                @endif
                                @if (can('read-student-certificate'))
                                <li class="submenu-item">
                                    <a href="{{ route('student-certificate.index') }}" class='submenu-link'>Ijazah
                                        Mahasiswa</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @if (canAny(['read-student', 'read-user', 'read-position']))
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-hdd-stack-fill"></i>
                        <span>Data</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if (can('read-student'))
                                <li class="submenu-item">
                                    <a href="{{ route('student.index') }}" class='submenu-link'>Mahasiswa</a>
                                </li>
                                @endif
                                @if (can('read-user'))
                                <li class="submenu-item">
                                    <a href="{{ route('user.index') }}" class='submenu-link'>User / Pegawai
                                        Universitas</a>
                                </li>
                                @endif
                                @if (can('read-position'))
                                <li class="submenu-item">
                                    <a href="{{ route('position.index') }}" class='submenu-link'>Jabatan</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @if (can('request-leave-permit-letter'))
                <li class="menu-item">
                    <a href="{{ route('my.leave-permit-letter.index') }}" class='menu-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Izin Cuti</span>
                    </a>
                </li>
                @endif
                @if (can('read-received-sppd-letter'))
                <li class="menu-item">
                    <a href="{{ route('my.sppd-letter.index') }}" class='menu-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Perintah Perjalanan Dinas</span>
                    </a>
                </li>
                @endif
                @if (canAny(['generate-incoming-letter-report']))
                <li class="menu-item has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-file-text"></i>
                        <span>Laporan</span>
                    </a>
                    <div class="submenu">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if (can('generate-incoming-letter-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.incoming-letter.index') }}" class='submenu-link'>Surat Masuk</a>
                                </li>
                                @endif
                                @if (can('generate-incoming-letter-disposition-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.incoming-letter-disposition.index') }}" class='submenu-link'>Disposisi Surat Masuk</a>
                                </li>
                                @endif
                                @if (can('generate-active-student-letter-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.active-student-letter.index') }}" class='submenu-link'>Surat Keterangan Mahasiswa Aktif</a>
                                </li>
                                @endif
                                @if (can('generate-school-transfer-letter-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.school-transfer-letter.index') }}" class='submenu-link'>Surat Keterangan Pindah Universitas</a>
                                </li>
                                @endif
                                @if (can('generate-sppd-letter-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.sppd-letter.index') }}" class='submenu-link'>Surat Perintah Perjalanan Dinas</a>
                                </li>
                                @endif
                                @if (can('generate-leave-permit-letter-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.leave-permit-letter.index') }}" class='submenu-link'>Surat Izin Cuti</a>
                                </li>
                                @endif
                                @if (can('generate-school-document-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.school-document.index') }}" class='submenu-link'>Arsip Dokumen Universitas</a>
                                </li>
                                @endif
                                @if (can('generate-student-certificate-report'))
                                <li class="submenu-item">
                                    <a href="{{ route('report.student-certificate.index') }}" class='submenu-link'>Arsip Ijazah Mahasiswa</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                <li class="menu-item">
                    <a href="{{ route('notification.index') }}" class='menu-link'>
                        <i class="bi bi-bell-fill"></i>
                        <span>Notifikasi
                            @if ($notificationCount = auth()->user()->unreadNotifications->count())
                            <span class="badge bg-light-secondary p-1" style="line-height: .95">{{ $notificationCount }}
                            </span>
                            @endif
                        </span>
                    </a>
                </li>
                @else
                <li class="menu-item">
                    <a href="{{ route('login.index') }}" class='menu-link'>
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('register.index') }}" class='menu-link'>
                        <i class="bi bi-person-plus"></i>
                        <span>Registrasi</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('password.request') }}" class='menu-link'>
                        <i class="bi bi-lock"></i>
                        <span>Lupa Kata Sandi</span>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>