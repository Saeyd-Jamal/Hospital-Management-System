<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">تعديل بيانات دواء : {{$medicine->name}}</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('medicines.update',$medicine->id) }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.medicines._from')
        </form>
    </div>
    {{-- modal --}}
    @if (isset($editItem))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل تريد حذف الدواء : {{$medicine->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{route('medicines.destroy',$medicine->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @push('scripts')
    <script src="{{asset('js-custom/profitFilde.js')}}"></script>
    @endpush

</x-front-layout>
