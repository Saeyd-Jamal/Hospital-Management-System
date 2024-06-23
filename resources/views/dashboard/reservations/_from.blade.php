<div class="row mt-3">
        <div class="form-group col-md-3">
            <label>رقم هوية المريض</label>
            <div class="input-group mb-3">
                <x-form.input type="number" :value="$reservation->patient_id" name="patient_id" readonly required />
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#getPatient">
                    <i class="fe fe-search"></i>
                </button>
            </div>
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="date" name='date' label='تاريخ الحجز' :value="$reservation->date" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="number" name='price' min="0" label='سعر الكشفية' :value="$reservation->price" placeholder="20" required />
        </div>
        <div class="form-group col-md-3">
            <label for="status">الحالة</label>
            <select name="status" id="status" class="form-control" required>
                <option value="null">اختر الحالة</option>
                <option value="paid" selected>تم الدفع</option>
                <option value="unpaid">لم يتم الدفع</option>
                <option value="treated">تم العلاج</option>
            </select>
        </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-3">
        <label for="section_id">إختيار القسم</label>
        <select name="section_id" id="section_id" class="form-control" required>
            <option @selected($reservation->section_id == null)>اختر القسم</option>
            @foreach ($sections as $section)
                <option value="{{$section->id}}"  @selected($reservation->section_id == $section->id)>{{$section->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="doctor_id">إسم الطبيب</label>
        <select name="doctor_id" id="doctor_id" class="form-control" required>
            <option>اختر القسم الموجود به الطبيب</option>
            @if ($reservation->doctor_id)
                <option value="{{$reservation->doctor_id}}" selected>{{$reservation->doctor->name}}</option>
            @endif
        </select>
    </div>
</div>
<div class="row mt-3">
</div>
<div class="d-flex justify-content-end w-100 mr-3">
    @if (isset($editItem))
    <button type="button" class="btn btn-danger mr-3"  data-toggle="modal" data-target="#exampleModal">
        <span class="fe fe-24 fe-delete"></span>
    </button>
    <button type="button" id="sendButton"  class="btn btn-primary">
        {{ $btn_label ?? 'أضف' }}
    </button>
    @else
    <button type="submit"class="btn btn-primary">
        {{ $btn_label ?? 'أضف' }}
    </button>
    @endif

</div>


