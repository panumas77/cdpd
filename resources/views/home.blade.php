@extends('layout.app')

@section('title', 'หน้าแรก | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">สวัสดี, {{ Auth::user()->name }}</h1>
    <hr>
    <div class="container pt-3">
        <div class="row">
            <div class="order-3 order-xxl-0 pb-3">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-4 g-3">
                    <div class="col">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="{{ route('services.form',0) }}">
                            <div class="card text-center text-bg-success">
                                <span class="display-3 pt-3"><i class='bx bx-donate-heart'></i></span>
                                <div class="card-body">
                                    <h5 class="card-title">บริการ </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="{{ route('patients.form') }}">
                            <div class="card text-center text-bg-primary">
                                <span class="display-3 pt-3"><i class='bx bx-handicap'></i></span>
                                <div class="card-body">
                                    <h5 class="card-title">ลงทะเบียนผู้พิการ </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="{{ route('caregivers.form') }}">
                            <div class="card text-center text-bg-secondary">
                                <span class="display-3 pt-3"><i class='bx bx-male-female'></i></span>
                                <div class="card-body">
                                    <h5 class="card-title">ลงทะเบียนผู้ดูแล </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="{{ route('reports.index') }}">
                            <div class="card text-center text-bg-warning">
                                <span class="display-3 pt-3"><i class='bx bx-notepad'></i></span>
                                <div class="card-body">
                                    <h5 class="card-title">รายงาน </h5>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="order-0 order-xxl-1">
                <div class="pb-3">
                    <h1 class="display-6">ค้นหาผู้พิการ</h1>
                </div>
                <div class="row pb-5">
                    <form action="{{ route('home') }}" method="GET" class="d-flex" role="search">
                        <input class="form-control me-2" value="{{ request('search', '') }}" name="search" type="search"
                            placeholder="ชื่อ,เลขบัตรประชาชน,เบอร์มือถือ" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                    </form>
                </div>
            </div>

            @if (isset($patients))
                <div class="order-2 order-xxl-2 pb-5">
                    <div class="pb-3">
                        <?php $row_loop = 4; //for loop row and column search result. ?>
                        @foreach ($patients as $patient)
                            @if ($row_loop == 4)
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-4 g-3">
                            @endif
                            <div class="col">
                                <div class="card">                            
                                        <img src="{{ $patient->getImageURL() }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $patient->full_name }}</h5>
                                        <p class="card-text">
                                            {{ $patient->address . ' ' . $patient->district . ' ' . $patient->amphoe . ' ' . $patient->province . ' ' . $patient->zipcode }}
                                        </p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>เลขบัตรประชาชน
                                                :</strong>{{ $patient->personal_id_number }}</li>
                                        <li class="list-group-item"><strong>วันเกิด :</strong> {{ date('d/m/Y', strtotime($patient->getThDate())) }}
                                            <strong>อายุ : {{$patient->getAge()}}ปี</strong>
                                        </li>
                                        <li class="list-group-item"><strong>เบอร์โทร :</strong>
                                            {{ $patient->phone_number }}</li>
                                        <li class="list-group-item"><strong>ผู้ดูแล :</strong> </li>
                                        <li class="list-group-item"><strong>เบอร์โทรผู้ดูแล :</strong> </li>
                                    </ul>
                                    <div class="card-body">
                                        <a href="{{route('services.form',$patient->id)}}" class="card-link">รับบริการ</a>
                                        <a href="{{route('patients.show',$patient->id)}}" class="card-link">ประวัติการรับบริการ</a>
                                        <a href="{{ route('patients.edit', $patient->id) }}" class="card-link">แก้ไข</a>
                                    </div>
                                </div>
                            </div>

                            @if ($row_loop == 3)
                    </div>
                    <?php $row_loop = 1; ?>
            @endif
            <?php $row_loop++; ?>
            @endforeach

        </div>
    </div>
    @endif


    </div>
    </div>
@endsection
