<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Baby Elephant Shoot</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 " id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>


    <!-- Navbar-->
    <ul class="navbar-nav ms-auto  me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item text-truncate" href="{{route('users.show',auth()->user()->username)}}">
                        {{\Str::limit(auth()->user()->name, 8)}} <span class="badge bg-{{colorRole()}}">{{auth()->user()->role->name}}</span>
                    </a></li>

                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item cursor-pointer">

                        <form action="/logout" method="post" onclick="this.submit()">
                            @csrf
                            Keluar
                        </form>
                    </a></li>
            </ul>
        </li>
    </ul>
</nav>