<header class='mb-5 bg-white'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                @php
                $user = auth()->user();
                @endphp
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link text-gray-600" href="{{ route('notification.index') }}">
                            @if ($notificationCount = $user->unreadNotifications->count())
                            <i class='bi bi-bell-fill bi-sub fs-4 text-primary' style="vertical-align: middle;"></i>
                            <span class="badge bg-light-secondary" style="">{{ $notificationCount }}
                            </span>
                            @else
                            <i class='bi bi-bell bi-sub fs-4' style="vertical-align: middle;"></i>
                            @endif
                        </a>
                    </li>
                </ul>
                <div>
                    <a href="{{ route('account.index') }}">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ $user->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ $user->role }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ $user->avatar() }}">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>
</header>