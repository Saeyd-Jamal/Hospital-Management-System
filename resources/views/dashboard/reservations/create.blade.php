<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">إنشاء حجز جديد</h2>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('reservations.store') }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @include('dashboard.reservations._from')
        </form>
    </div>
    <!-- getPatient -->
    <div class="modal fade" id="getPatient" tabindex="-1" role="dialog" aria-labelledby="getPatientLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="getPatientLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <x-form.input name="patient_id" label="رقم الهوية" type="number" class="form-control patient_search"
                                    placeholder="إملا رقم هوية المريض" data-id="patient_id" />
                            </div>
                            <div class="form-group col-md-6">
                                <x-form.input name="patient_name" label="إسم المريض" type="text" class="form-control patient_search"
                                    placeholder="إملا إسم المريض" data-id="patient_name" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">رقم الهوية</th>
                                    <th scope="col">الإسم</th>
                                    <th scope="col">تاريخ الميلاد</th>
                                </tr>
                            </thead>
                            <tbody id="table_patient">
                                <tr>
                                    <td colspan='3'>يرجى تعبئة البيانات</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
            const app_link = "{{ config('app.url') }}";
        </script>
        <script src="{{ asset('js-custom/sendCheckedRes.js') }}"></script>
        <script src="{{ asset('js-custom/reception.js') }}"></script>

    @endpush
</x-front-layout>
