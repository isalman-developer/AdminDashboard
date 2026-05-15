<!-- User -->
<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            @php $navAvatar = auth()->user()?->media()->where('type', 'avatar')->latest('id')->first(); @endphp
            @if ($navAvatar)
                <img src="{{ asset('uploads/avatars/' . basename($navAvatar->file_path)) }}" alt class="rounded-circle" />
            @else
                <img src="{{ asset('admin-assets/img/avatars/1.png') }}" alt class="rounded-circle" />
            @endif
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <div class="px-3 pt-3 pb-2 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        <div class="avatar avatar-online">
                            @if ($navAvatar)
                                <img src="{{ asset('uploads/avatars/' . basename($navAvatar->file_path)) }}" alt class="rounded-circle" />
                            @else
                                <img src="{{ asset('admin-assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                            @endif
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">{{ auth()->user()->name ?? 'User' }}</h6>
                        <small class="text-body-secondary">
                            {{ auth()->user()->roles->first()?->name ?? 'User' }}
                        </small>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown-divider my-1 mx-n2"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                <i class="icon-base ti tabler-user me-3 icon-md"></i><span class="align-middle">Profile</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                <i class="icon-base ti tabler-settings me-3 icon-md"></i><span class="align-middle">Settings</span>
            </a>
        </li>
        <li>
            <div class="dropdown-divider my-1 mx-n2"></div>
        </li>
        <li>
            <div class="d-grid px-2 pt-2 pb-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-danger d-flex w-100" type="submit">
                        <small class="align-middle">Logout</small>
                        <i class="icon-base ti tabler-logout ms-2"></i>
                    </button>
                </form>
            </div>
        </li>
    </ul>
</li>
<!--/ User -->
