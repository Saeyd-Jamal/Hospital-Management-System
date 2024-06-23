<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">تعديل بيانات فاتورة رقم : {{ $bill->id }}</h2>
        </div>

    </div>
    <div class="row">
            <div class="row mt-3">
                <div class="form-group col-md-3">
                    <label>رقم هوية المريض</label>
                    <div class="input-group mb-3">
                        <x-form.input type="number" :value="$reservation->patient->patient_id" name="patient_id" readonly  />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label> اسم المريض</label>
                    <div class="input-group mb-3">
                        <x-form.input type="text" :value="$reservation->patient->name" name="patient_id" readonly  />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <x-form.input type="date" name='date' label='تاريخ الحجز' :value="$reservation->date"  />
                </div>
                <div class="form-group col-md-3">
                    <x-form.input type="number" name='price' min="0" label='سعر الكشفية' :value="$reservation->price"
                        placeholder="20"  />
                </div>
                <div class="form-group col-md-3">
                    <x-form.input name='status' label="الحالة" :value="$reservation->status"/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-md-3">
                    <x-form.input name='section_id' label=" القسم" :value="$reservation->section->name"/>
                </div>
                <div class="form-group col-md-3">
                    <x-form.input name='doctor_id' label=' الطبيب' :value="$reservation->doctor->name"/>
                </div>
            </div>


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
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="name">
                                            <a href="{{ route('medicines.edit', $medicine->id) }}"
                                                class="nav-item">{{ $medicine->name }}</a>
                                        </td>
                                        <td>{{ $medicine->end_date }}</td>
                                        <td id="price_sale_{{ $medicine->id }}">{{ $medicine->price_sale }}</td>
                                        <td hidden id="profit_{{ $medicine->id }}">{{ $medicine->profit }}</td>
                                        <td>{{ $medicine->quantity }}</td>
                                        <td>
                                            {{ $medicine->pivot->quantity }}
                                        </td>
                                        <td class="total_price" id="total_price_{{ $medicine->id }}">
                                            {{ $medicine->pivot->price }}
                                        </td>
                                        <td hidden class="final_profit" id="final_profit_{{ $medicine->id }}">
                                            {{ $medicine->pivot->profit }}
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
</x-front-layout>
