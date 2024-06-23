<div class="row mt-3">
        <div class="form-group col-md-6">
            <x-form.input name='name' label='اسم الفحص' :value="$laboratoryTest->name_test" placeholder="laboratoryTest" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="number" name='price' label='سعر البيع' min="0" step=".01" :value="$laboratoryTest->price" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="file" class="form-control-file" label="ملف افتراضي للفحص" name="file_test_u" />
            @if ($laboratoryTest->file_test)
                <a href="{{$laboratoryTest->file_test_url}}" download>تحميل ملف الفحص</a>
            @endif
        </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-12">
        <x-form.textarea name="description" label="وصف للفحص" :value="$laboratoryTest->description" placeholder="وصف لفحص........." />
    </div>
</div>
<div class="d-flex justify-content-end w-100 mr-3">
    @if (isset($editItem))
    <button type="button" class="btn btn-danger mr-3"  data-toggle="modal" data-target="#exampleModal">
        <span class="fe fe-24 fe-delete"></span>
    </button>
    @endif
    <button type="submit" class="btn btn-primary">
        {{ $btn_label ?? 'أضف الفحص الحالي' }}
    </button>
</div>


