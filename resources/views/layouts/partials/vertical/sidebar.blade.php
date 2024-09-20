<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative" style="padding-top: 1rem;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('home.index') }}" style="font-size: 25px;">{{ config('app.name') }}</a>
                </div>

                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item">
                    <a href="{{ route('home.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (canAny(['read-incoming-letter', 'read-incoming-letter-category', 'read-incoming-letter-disposition']))
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Masuk</span>
                    </a>
                    <ul class="submenu">
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
                </li>
                @endif
                @if (canAny([
                'read-active-student-letter',
                'read-school-transfer-letter',
                'read-pindah-prodi',
                'read-sppd-letter',
                'read-leave-permit-letter',
                ]))
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Keluar</span>
                    </a>
                    <ul class="submenu">
                        @if (can('read-active-student-letter'))
                        <li class="submenu-item">
                            <a href="{{ route('active-student-letter.index') }}" class='submenu-link'>Surat
                                Mahasiswa Aktif</a>
                        </li>
                        @endif
                        @if (can('read-school-transfer-letter'))
                        <li class="submenu-item">
                            <a href="{{ route('school-transfer-letter.index') }}" class='submenu-link'>Surat
                                Pindah Universitas</a>
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
                </li>
                @endif

                @if (canAny(['read-school-document', 'read-student-certificate']))
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-archive-fill"></i>
                        <span>Arsip</span>
                    </a>
                    <ul class="submenu">
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
                </li>
                @endif

                @if (canAny(['read-student', 'read-user', 'read-position']))
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-hdd-stack-fill"></i>
                        <span>Data</span>
                    </a>
                    <ul class="submenu">
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
                </li>
                @endif

                @if (canAny([
                'generate-incoming-letter-report',
                'generate-incoming-letter-disposition-report',
                'generate-active-student-letter-report',
                'generate-school-transfer-letter-report',
                'generate-sppd-letter-report',
                'generate-leave-permit-letter-report',
                'generate-school-document-report',
                'generate-student-certificate-report',
                'generate-letter-statistic-report',
                ]))
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-text"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="submenu">
                        @if (can('generate-incoming-letter-report'))
                        <li class="submenu-item">
                            <a href="{{ route('report.incoming-letter.index') }}" class='submenu-link'>Surat
                                Masuk</a>
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
                            <a href="{{ route('report.sppd-letter.index') }}" class='submenu-link'>Surat
                                Perintah Perjalanan Dinas</a>
                        </li>
                        @endif
                        @if (can('generate-leave-permit-letter-report'))
                        <li class="submenu-item">
                            <a href="{{ route('report.leave-permit-letter.index') }}" class='submenu-link'>Surat Izin Cuti</a>
                        </li>
                        @endif
                        @if (can('generate-school-document-report'))
                        <li class="submenu-item">
                            <a href="{{ route('report.school-document.index') }}" class='submenu-link'>Arsip
                                Dokumen Universitas</a>
                        </li>
                        @endif
                        @if (can('generate-student-certificate-report'))
                        <li class="submenu-item">
                            <a href="{{ route('report.student-certificate.index') }}" class='submenu-link'>Arsip Ijazah Mahasiswa</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if (can('request-leave-permit-letter'))
                <li class="sidebar-item">
                    <a href="{{ route('my.leave-permit-letter.index') }}" class='sidebar-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Izin Cuti</span>
                    </a>
                </li>
                @endif
                @if (can('read-received-sppd-letter'))
                <li class="sidebar-item">
                    <a href="{{ route('my.sppd-letter.index') }}" class='sidebar-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Surat Perjalanan Dinas</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-title">Akun</li>
                <li class="sidebar-item  ">
                    <a href="{{ route('account.index') }}" class='sidebar-link'>
                        <i class="fas fa-user"></i>
                        <span>Akun Saya</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="{{ route('notification.index') }}" class='sidebar-link'>
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button onclick="return confirm('Keluar dari aplikasi?')" type="submit" class='sidebar-link bg-transparent border-0'>
                            <i class="fas fa-right-from-bracket"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>

                @if (can('manage-system'))
                <li class="sidebar-title">Sistem</li>
                <li class="sidebar-item  ">
                    <a href="{{ route('system.activities') }}" class='sidebar-link'>
                        <i class="fas fa-clock"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>