<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">أطباء المستشفى</h2>
        </div>
        <div class="col-auto">
            <div class="form-group d-flex align-items-center">
                <a href="{{route('doctors.create')}}" type="button" class="nav-link" style="display: inline">
                    <span style="font-size: 35px" class="fe fe-plus-square text-primary"></span>
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
                                <th>اسم الطبيب</th>
                                <th>رقم الهوية</th>
                                <th>رقم الجوال</th>
                                <th>حالته</th>
                                <th>التخصص</th>
                                <th>القسم</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr>
                                <td  width="50px" height="50px">
                                    <img src="{{$doctor->image_url}}" alt="..." width="50px" height="50px">
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('doctors.edit',$doctor->id)}}" class="nav-item">{{$doctor->name}}</a>
                                </td>
                                <td>{{$doctor->doctor_id}}</td>
                                <td>{{$doctor->phone_number}}</td>
                                <td>
                                    @if ($doctor->status == 0)
                                        غير متواجد
                                    @elseif ($doctor->status == 1)
                                        متواجد
                                    @endif
                                </td>
                                <td>{{$doctor->specialty}}</td>
                                <td>{{$doctor->section->name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('doctors.edit',$doctor->id)}}">تعديل</a>
                                            <form action="{{route('doctors.destroy',$doctor->id)}}" method="POST">
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
            {{ $doctors->links()}}
        </div> <!-- Striped rows -->
    </div>
</x-front-layout>
