<div class="row ">
    <div class="col-12">
        <div class="form-group">
            <x-form.input name='name' label='إسم القسم' :value="$section->name" placeholder="اسم القسم"
                required />
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <x-form.textarea name="description" label="وصف للقسم" :value="$section->description" placeholder="وصف القسم" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <x-form.input type="file" class="form-control-file" label="صورة للقسم" name="imageFile" accept='image/*' />
            @if ($section->logo_image)
                <img class="mt-3" src="{{$section->image_url}}" alt="..." height="100px">
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
            {{ $btn_label ?? 'أضف القسم' }}
        </button>
    </div>

</div>

