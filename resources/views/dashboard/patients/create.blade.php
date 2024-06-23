<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">إضافة مريض جديد</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('patients.store') }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @include('dashboard.patients._from')
        </form>
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="form-group">
                <form action="{{route('patients.importExcel')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-form.input type="file" class="form-control-file" label="رفع ملف إكسيل" name="fileExcel" required />
                    <button type="submit" class="btn btn-primary mt-3">رفع ملف إكسيل</button>
                </form>
                <a href="{{asset('files/patients_file.xlsx')}}" download>تحميل ملف التعبئة</a>
            </div>
        </div>
    </div>


</x-front-layout>
