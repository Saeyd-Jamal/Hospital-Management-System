<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">فحوصات المختبر المتوفرة</h2>
        </div>
        <div class="col-auto">
            <div class="form-group d-flex align-items-center">
                <a href="{{route('laboratory_tests.create')}}" type="button" class="nav-link" style="display: inline">
                    <span style="font-size: 35px" class="fe fe-plus-square text-primary"></span>
                </a>
                <a href="{{route('laboratory_tests.exportExcel')}}" type="button" class="btn btn-info nav-link" style="display: inline">
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
                                <th>#</th>
                                <th>اسم الفحص</th>
                                <th>الوصف</th>
                                <th>سعر</th>
                                <th>الملف</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laboratoryTests as $laboratoryTest)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('laboratory_tests.edit',$laboratoryTest->id)}}" class="nav-item">{{$laboratoryTest->name_test}}</a>
                                </td>
                                <td>{{$laboratoryTest->description}}</td>
                                <td>{{$laboratoryTest->price}}</td>
                                <td>
                                @if ($laboratoryTest->file_test_url)
                                    <a href="{{$laboratoryTest->file_test_url}}" download>تحميل</a>
                                @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('laboratory_tests.edit',$laboratoryTest->id)}}">تعديل</a>
                                            <form action="{{route('laboratory_tests.destroy',$laboratoryTest->id)}}" method="POST">
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
            {{ $laboratoryTests->links()}}
        </div> <!-- Striped rows -->
    </div>
</x-front-layout>
