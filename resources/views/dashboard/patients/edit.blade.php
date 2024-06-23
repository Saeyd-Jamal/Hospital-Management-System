<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">تعديل بيانات المريض : {{$patient->name}}</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('patients.update',$patient->id) }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.patients._from')
        </form>
    </div>
    {{-- modal --}}
    @if (isset($editItem))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل تريد حذف قسم {{$patient->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{route('patients.destroy',$patient->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

</x-front-layout>
