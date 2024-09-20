<div id="sidebar" class="active">
    <div class="sidebar-wrapper">
        <div class="sidebar-header position-relative" style="padding-top: 1rem;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ '/' }}" style="font-size: 25px;">{{ config('app.name') }}</a>
                </div>

                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item">
                    <a href="{{ '/' }}" class='sidebar-link'>
                        <i class="fas fa-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('login.index') }}" class='sidebar-link'>
                        <i class="fas fa-right-to-bracket"></i>
                        <span>Login</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('register.index') }}" class='sidebar-link'>
                        <i class="fas fa-user-plus"></i>
                        <span>Registrasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('password.request') }}" class='sidebar-link'>
                        <i class="fas fa-lock"></i>
                        <span>Lupa Sandi</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
