<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <img class="mt-3 d-inline" src="{{$section->image_url}}" alt="..." height="70px">
            <h2 class="h5 page-title d-inline">قسم {{$section->name}}</h2>
            <p class="text-muted">{{ $section->discription }}</p>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <a href="{{route('sections.edit',$section->id)}}" class="nav-link">
                    <span style="font-size: 35px" class="fe fe-edit text-info"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">أطباء القسم</h5>
                    <p class="card-text">عدد الأطباء هم {{$section->doctors->count()}}</p>
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
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($section->doctors as $doctor)
                            <tr>
                                <td  width="50px" height="50px">
                                    <img src="{{$doctor->image_url}}" alt="..." width="50px" height="50px">
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('doctors.show',$doctor->id)}}" class="nav-item">{{$doctor->name}}</a>
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
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('doctors.edit',$section->id)}}">تعديل</a>
                                            <form action="{{route('doctors.destroy',$section->id)}}" method="POST">
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
        </div>
    </div>
</x-front-layout>
