<div class="row mt-3">
    <div class="form-group col-md-4">
        <x-form.input name='name' label='إسم الطبيب' :value="$doctor->name" placeholder="اسم الطبيب" required />
    </div>
    <div class="form-group col-md-4">
        <x-form.input name='doctor_id'
                        label='رقم هوية الطبيب'
                        :value="$doctor->doctor_id"
                        placeholder="رقم الهوية"
                        minlength="9"
                        maxlength='9'
                        required />
    </div>
    <div class="form-group col-md-4">
        <x-form.input name='username' label='اسم المستخدم له' :value="$doctor->username" placeholder="اسم المستخدم الذي يلزمه لتسجيل الدخول" required />
    </div>
</div>
<div class="row  mt-3">
    <div class="form-group col-md-4">
        <x-form.input type="password" name='password' label='كلمة المرور الخاصة به' placeholder="*****" />
    </div>
    <div class="form-group col-md-4">
        <x-form.input name='phone_number' label='رقم الهاتف' :value="$doctor->phone_number" placeholder="+972594318545"  />
    </div>
    <div class="form-group col-md-4">
        <label for="section_id">القسم الخاص بالطبيب</label>
        <select name="section_id" id="section_id" class="form-control">
            <option value="null" @selected($doctor->section_id == null)>اختر القسم</option>
            @foreach ($sections as $section)
                <option value="{{$section->id}}" @selected($doctor->section_id == $section->id)>{{$section->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row  mt-3">
    <div class="form-group col-md-4">
        <x-form.input name='specialty' label='تخصص الطبيب' :value="$doctor->specialty" placeholder="........." />
    </div>
    <div class="form-group col-md-4">
        <x-form.input type="file" class="form-control-file" label="صورة للطبيب" name="imageFile" accept='image/*' />
        @if ($doctor->image)
            <img class="mt-3" src="{{$doctor->image_url}}" alt="..." height="100px">
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

