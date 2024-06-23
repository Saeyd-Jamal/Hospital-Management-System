<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">الحجوزات</h2>
        </div>
        <div class="col-auto">
            <div class="form-group d-flex align-items-center">
                <a href="{{route('reservations.create')}}" type="button" class="nav-link" style="display: inline">
                    <span style="font-size: 35px" class="fe fe-plus-square text-primary"></span>
                </a>
                <form action="{{route('exportExcel')}}" method="get">
                    @csrf
                    <input type="hidden" name='model' value="{{$model}}"  />
                    <input type="hidden" name='modelName' value="{{$modelName}}"  />
                    <input type="hidden" name='colmesNames'value="{{$colmesNames}}"  />
                    <input type="hidden" name='colmesNamesHeading'value="{{$colmesNamesHeading}}"  />
                    <button type="submit" class="btn btn-info nav-link" style="display: inline">
                        <span style="font-size: 20px" class="fe fe-external-link"></span>
                        تصدير إكسيل
                    </button>
                </form>
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
                                <th>اسم المريض</th>
                                <th>الطبيب</th>
                                <th>التاريخ</th>
                                <th>الكشفية</th>
                                <th>الحدث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('reservations.edit',$reservation->id)}}" class="nav-item">{{$reservation->patient->name}}</a>
                                </td>
                                <td>{{$reservation->doctor->name}}</td>
                                <td>{{$reservation->date}}</td>
                                <td>{{$reservation->price}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dr1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                            <a class="dropdown-item" href="{{route('reservations.show',$reservation->id)}}">تعديل</a>
                                            <form action="{{route('reservations.destroy',$reservation->id)}}" method="POST">
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
            {{ $reservations->links()}}
        </div> <!-- Striped rows -->
    </div>
</x-front-layout>
