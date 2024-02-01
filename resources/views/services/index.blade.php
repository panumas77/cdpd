@extends('layout.app')

@section('title', 'ฐานข้อมูลผู้พิการ | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">ข้อมูลการบริการ <small>จำนวน {{ $service_count }} </small></h1>
    <hr>
    <div class="order-0 order-xxl-1">
        <div class="pb-3">
            <h3>ค้นหาผู้พิการ</h3>
        </div>
        <div class="row pb-5">
            <form action="{{ route('services.index') }}" method="GET" class="d-flex" role="search">
                <input class="form-control me-2" value="{{ request('search', '') }}" name="search" type="search"
                    placeholder="ชื่อ,เลขบัตรประชาชน,เบอร์มือถือ" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">ค้นหา</button>
            </form>
        </div>
    </div>
{{-- Pagination ideas section --}}
<div>
  {{ $services->withQueryString()->links() }}
</div>
{{-- Pagination ideas section --}}
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center">#</th>
                <th class="d-none d-lg-table-cell">วันที่รับบริการ</th>
                <th>ชื่อ-สกุล</th>
                <th class="d-none d-lg-table-cell text-center">เพศ</th>
                <th>การบริการ</th>
                <th class="d-none d-lg-table-cell">ผู้ให้บริการ</th>
                <th class="text-center">คำสั่ง</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @php
                $no = $services->firstItem();
            @endphp
            @foreach ($services as $service)
                <tr>
                    <td class="text-center">{{ $no }}</td>
                    <td class="d-none d-lg-table-cell">{{ $service->getThDate() }}</td>
                    <td>{{ $service->patient->full_name }} (อายุ {{$service->patient->getAge()}}ปี)</td>
                    <td class="d-none d-lg-table-cell text-center">{{ $service->patient->gender }}</td>
                    <td>{{ $service->service_category->short_name }}</td>
                    <td class="d-none d-lg-table-cell">{{ $service->user->name }}</td>
                    <td class="text-center">
                        <!-- Action buttons -->
                        <button class="btn btn-info btn-sm btn-view" data-serviceid="{{ $service->id }}"><i
                                class="fa-solid fa-info"></i></button>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <button class="btn btn-danger btn-sm btn-delete" data-serviceid="{{ $service->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ลบข้อมูล."><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    </table>
    {{-- Pagination ideas section --}}
    <div class="mt-3">
        {{ $services->withQueryString()->links() }}
    </div>
    {{-- Pagination ideas section --}}
@endsection

@section('script')
@endsection
