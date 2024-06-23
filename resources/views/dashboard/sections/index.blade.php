<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">أقسام المستشفى</h2>
        </div>
        <div class="col-auto">
            <div class="form-group d-flex align-items-center">
                <a href="{{route('sections.create')}}" type="button" class="nav-link" style="display: inline">
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
                    <h5 class="card-title">الأقسام</h5>
                    <p class="card-text">هنا يمكنك مشاهدة الأقسام وعرضها مع أطبائها والتعديل عليها</p>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>عدد الأطباء</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                            <tr>
                                <td  width="50px" height="50px">
                                    <img src="{{$section->image_url}}" alt="..." width="50px" height="50px">
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('sections.show',$section->id)}}" class="nav-item">{{$section->name}}</a>
                                </td>
                                <td>{{$section->doctors->count()}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('sections.edit',$section->id)}}">تعديل</a>
                                            <form action="{{route('sections.destroy',$section->id)}}" method="POST">
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
            {{ $sections->links()}}
        </div> <!-- Striped rows -->
    </div>
</x-front-layout>
