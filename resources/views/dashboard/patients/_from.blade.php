<div class="row mt-3">
    <div class="form-group col-md-4">
        <x-form.input name='name' label='إسم المريض' :value="$patient->name" placeholder="اسم المريض" required />
    </div>
    <div class="form-group col-md-4">
        <x-form.input name='patient_id'
                        label='رقم هوية للمريض'
                        :value="$patient->patient_id"
                        placeholder="رقم الهوية"
                        minlength="9"
                        maxlength='9'
                        required />
    </div>
    <div class="form-group col-md-4">
        <x-form.input type="date" name='date_of_birth' label='تاريخ الميلاد' :value="$patient->date_of_birth" />
    </div>
</div>
<div class="row  mt-3">
    <div class="form-group col-md-4">
        <x-form.input name='address' label='عنوان المريض' :value="$patient->address" placeholder="غزة- الوسطى - المغازي" />
    </div>
    <div class="form-group col-md-4">
        <x-form.input name='phone_number' label='رقم الهاتف' :value="$patient->phone_number" placeholder="+972594318545"  />
    </div>

    <div class="form-group col-md-4">
        <label for="gender">الجنس</label>
        <select name="gender" id="gender" class="form-control">
            <option value="ذكر" @selected($patient->gender == "ذكر")>ذكر</option>
            <option value="أنثى" @selected($patient->gender == "أنثى")>أنثى</option>
        </select>
    </div>
</div>

<div class="row  mt-3">
    <div class="form-group col-md-4">
        <x-form.input type="file" class="form-control-file" label="صورة للطبيب" name="imageFile" accept='image/*' />
        @if ($patient->image)
            <img class="mt-3" src="{{$patient->image_url}}" alt="..." height="100px">
        @endif
    </div>
</div>
<div class="d-flex justify-content-end w-100 mr-3">
    @if (isset($editItem))
    <button type="button" class="btn btn-danger mr-3"  data-toggle="modal" data-target="#exampleModal">
        <span class="fe fe-24 fe-delete"></span>
    </button>
    @endif
    <button type="submit" class="btn btn-primary">
        {{ $btn_label ?? 'أضف' }}
    </button>
</div>

