@extends('layout.app')

@section('title', 'Login | CDPD Thailand Data')

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="px-5 ms-xl-4">
                        <i class="fa-solid fa-hospital fa-3x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">CDPD Thailand</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form action="{{ route('login') }}" class="needs-validation" novalidate method="post"
                            style="width: 23rem;">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">ล็อกอิน</h3>

                            <div class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg"
                                    placeholder="ชื่อผู้ใช้" aria-label="ชื่อผู้ใช้" />
                                @error('username')
                                    <span class="d-block fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg"
                                    placeholder="พาสเวิร์ด" aria-label="พาสเวิร์ด" />
                                @error('password')
                                    <span class="d-block fs-6 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="pt-1 mb-4">
                                <input type="submit" class="btn btn-info btn-lg btn-block" value="เข้าระบบ">
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">ลืมพาสเวิร์ด?</a></p>

                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="<?= asset('storage/images/login_cover.jpg') ?>" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>

@endsection
