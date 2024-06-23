<div class="row mt-3">
        <div class="form-group col-md-3">
            <x-form.input type="date" name='test_date' label='تاريخ الفحص' :value="$reservation->test_date" required />
        </div>
        <div class="form-group col-md-3">
            <x-form.input type="number" name='total_price' label='السعر الاجمالي'  :value="$reservation->total_price"  disabled />
        </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-3">
        <label for="payment_method"></label>
        <select name="payment_method" id="payment_method" class="form-control">
            <option value="null">اختر طريقة الدفع</option>
            <option value="person" selected>حساب شخصي</option>
            <option value="hospital">حساب المستشفى</option>
            <option value="donation">حساب التبرعات</option>
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
    @endif
    <button type="button" id="sendButton"  class="btn btn-primary">
        {{ $btn_label ?? 'أضف' }}
    </button>
</div>


