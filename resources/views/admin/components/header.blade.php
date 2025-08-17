<nav class="navbar navbar-expand-lg navbar-dark" style="background:#1E1E2F; border-bottom:1px solid rgba(255,255,255,0.1);" id="admin-header">
    <div class="container-fluid">
        <!-- Right Side -->
        <div class="ms-auto">
            <ul class="navbar-nav align-items-center">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();"
                        style="background:var(--primary-color); color:#fff; border:none; padding:6px 14px; border-radius:4px;">
                        {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
