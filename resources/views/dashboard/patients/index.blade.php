<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">سجلات المرضى</h2>
        </div>
        <div class="col-auto">
            <div class="form-group d-flex align-items-center">
                <a href="{{route('patients.create')}}" type="button" class="nav-link" style="display: inline">
                    <span style="font-size: 35px" class="fe fe-plus-square text-primary"></span>
                </a>
                <a href="{{route('patients.exportExcel')}}" type="button" class="btn btn-info nav-link" style="display: inline">
                    <span style="font-size: 20px" class="fe fe-external-link"></span>
                    تصدير إكسيل
                </a>
            </div>
        </div>
    </div>
    <x-slot:breadcrumbs>
        {{-- Alarts --}}
        <x-alart type="success" />
        <x-alart type="warning" />
        <x-alart type="danger" />
    </x-slot:breadcrumbs>
    <div class="row">
        <!-- Striped rows -->
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>اسم المريض</th>
                                <th>رقم هويته</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>تاريخ الميلاد</th>
                                <th>الجنس</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                            <tr>
                                <td  width="50px" height="50px">
                                    <img src="{{$patient->image_url}}" alt="..." width="50px" height="50px">
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('patients.show',$patient->id)}}" class="nav-item">{{$patient->name}}</a>
                                </td>
                                <td>{{$patient->patient_id}}</td>
                                <td>{{$patient->phone_number}}</td>
                                <td>{{$patient->address}}</td>
                                <td>{{$patient->date_of_birth}}</td>
                                <td>{{$patient->gender}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('patients.edit',$patient->id)}}">تعديل</a>
                                            <form action="{{route('patients.destroy',$patient->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $patients->links()}}
        </div> <!-- Striped rows -->
    </div>
</x-front-layout>
