<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">الحجوزات المرسلة من الطبيب</h2>
        </div>
    </div>
    <x-slot:breadcrumbs>
        {{-- Alarts --}}
        <x-alart type="success" />
        <x-alart type="warning" />
        <x-alart type="danger" />
    </x-slot:breadcrumbs>
    <div class="row">
        <!-- Striped rows -->
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم المريض</th>
                                <th>تاريخ الشراء</th>
                                <th>طريقة الدفع</th>
                                <th>السعر الاجمالي</th>
                                <th>الربح الإجمالي</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)
                            <tr class="el">
                                <td>
                                    <a href="{{route('pharmacy.edit',$bill->id)}}" class="nav-item">{{$bill->id}}</a>
                                </td>
                                <td>
                                    <a href="{{route('pharmacy.edit',$bill->id)}}" class="nav-item">------</a>
                                </td> {{--$bill->reservation->patient->name--}}
                                <td>{{$bill->buy_date}}</td>
                                <td>{{$bill->payment_method}}</td>
                                <td>{{$bill->total_price}}</td>
                                <td>{{$bill->final_profit}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('pharmacy.edit',$bill->id)}}">تعديل</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $bills->links()}}
        </div> <!-- Striped rows -->
    </div>
    @push('scripts')
    <script>
        const csrf_token = "{{ csrf_token() }}";
        const app_link = "{{ config('app.url') }}";
    </script>
    <script src="{{asset('js-custom/reservationsAjax.js')}}"></script>
    @endpush
</x-front-layout>
