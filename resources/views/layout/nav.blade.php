<nav class="navbar navbar-expand-md" style="background-color: #DFCCFB;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset('storage/icon/globe-2-svgrepo-com.svg') }}" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            CDPDThailand Data
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">แดชบอร์ด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            ฐานข้อมูล
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('patients.index') }}">ผู้พิการ</a></li>
                            <!-- <li><a class="dropdown-item" href="\patients\add">เพิ่มผู้พิการ</a></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('caregivers.index') }}">ผู้ดูแล</a></li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('services.index') }}">บริการ</a></li>
                            <!-- <li><a class="dropdown-item" href="\caregivers\add">เพิ่มผู้ดูแล</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('saraban') }}">สารบรรญเอกสาร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('reports.index') }}">รายงาน</a>
                    </li>
                    @if (Auth::user()->role == 'Root')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">ผู้ใช้</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-danger" aria-current="page" href="{{ route('logout') }}">ออกจากระบบ</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>
