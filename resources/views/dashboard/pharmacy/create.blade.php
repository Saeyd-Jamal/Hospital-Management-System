<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">إنشاء فاتورة جديدة للصيدلية</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('pharmacy.store') }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @include('dashboard.pharmacy._from')
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group col-md-3">
                                <x-form.input name='searchInp' label='البحث عن الدواء' placeholder="" />
                            </div>
                        </div>
                        <table class="table table-striped table-hover" id="medicines_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>اسم الدواء</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th>سعر الوحدة</th>
                                    <th>الكمية المتوفرة</th>
                                    <th>الكمية المطلوبة</th>
                                    <th>السعر النهائي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicines as $medicine)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="checkbox_{{ $medicine->id }}" name="medicines_id[]" value="{{$medicine->id}}" class="form-control" >
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="name">
                                            <a href="{{ route('medicines.show', $medicine->id) }}"
                                                class="nav-item">{{ $medicine->name }}</a>
                                        </td>
                                        <td>{{ $medicine->end_date }}</td>
                                        <td id="price_sale_{{ $medicine->id }}">{{ $medicine->price_sale }}</td>
                                        <td hidden id="profit_{{ $medicine->id }}">{{ $medicine->profit }}</td>
                                        <td>{{ $medicine->quantity }}</td>
                                        <td>
                                            <x-form.input class="form-control-sm" type="number" class="quantity_required"
                                                name='quantity_required_{{ $medicine->id }}' data-id="{{ $medicine->id }}" min="0" />
                                        </td>
                                        <td class="total_price" id="total_price_{{ $medicine->id }}">
                                            {{ $medicine->price_sale * $medicine->quantity_required }}
                                        </td>
                                        <td hidden class="final_profit" id="final_profit_{{ $medicine->id }}">
                                            {{ $medicine->profit * $medicine->quantity_required }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- Striped rows -->
        </form>
    </div>
    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
            const app_link = "{{ config('app.url') }}";
        </script>
        <script src="{{ asset('js-custom/sendChecked.js') }}"></script>
    @endpush
</x-front-layout>
