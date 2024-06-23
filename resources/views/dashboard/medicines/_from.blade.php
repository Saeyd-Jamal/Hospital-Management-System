<div class="row mt-3">
        <div class="form-group col-md-3">
            <x-form.input name='name' label='اسم الدواء' :value="$medicine->name" placeholder="medicine" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input name='producing_company' label='الشركة المنتجة' :value="$medicine->producing_company" placeholder="Masroje" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="date" name='end_date' label='تاريخ الإنتهاء' :value="$medicine->end_date" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="number" min="0" name='quantity' label='الكمية الموجود' :value="$medicine->quantity" placeholder="100" required />
        </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-3">
        <x-form.input type="number" class="priceFildes" name='price_sale' label='سعر البيع' min="0" step=".01" :value="$medicine->price_sale" placeholder="" required />
    </div>
    <div class="form-group col-md-3">
        <x-form.input type="number" class="priceFildes" name='basic_price' label='السعر الاساسي' min="0" step=".01" :value="$medicine->basic_price" placeholder="" required />
    </div>
    <div class="form-group col-md-3">
        <x-form.input type="number" name='profit' label='الربح من البيع' min="0" step=".01" :value="$medicine->profit" placeholder="" required readonly />
    </div>
    <div class="form-group col-md-3">
        <x-form.input type="file" class="form-control-file" label="صورة للدواء" name="imageFile" accept='image/*' />
        @if ($medicine->medicine_image)
            <img class="mt-3" src="{{$medicine->image_url}}" alt="..." height="100px">
        @endif
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-12">
        <x-form.textarea name="description" label="وصف للدواء" :value="$medicine->description" placeholder="وصف للدواء" />
    </div>
</div>
<div class="d-flex justify-content-end w-100 mr-3">
    @if (isset($editItem))
    <button type="button" class="btn btn-danger mr-3"  data-toggle="modal" data-target="#exampleModal">
        <span class="fe fe-24 fe-delete"></span>
    </button>
    @endif
    <button type="submit" class="btn btn-primary">
        {{ $btn_label ?? 'أضف الدواء الحالي' }}
    </button>
</div>


