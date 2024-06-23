<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">تعديل بيانات الفحص : {{$laboratoryTest->name_test}}</h2>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('laboratory_tests.update',$laboratoryTest->id) }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.laboratory_tests._from')
        </form>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل تريد حذف الفحص : {{$laboratoryTest->name_test}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{route('laboratory_tests.destroy',$laboratoryTest->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-front-layout>
