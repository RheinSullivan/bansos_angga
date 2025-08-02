<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="nav-link">{{ Auth::user()->name }}</span>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-danger">Logout</button>
            </form>
        </li>
    </ul>
</nav>
