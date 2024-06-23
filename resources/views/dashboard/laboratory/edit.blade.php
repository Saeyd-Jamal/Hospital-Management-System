<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">تعديل بيانات فاتورة رقم : {{$reservation->id}}</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('laboratory.update', $reservation->id)}}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.laboratory._from')
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group col-md-3">
                                <x-form.input name='searchInp' label='البحث عن الدواء' placeholder="" />
                            </div>
                        </div>
                        <table class="table table-striped table-hover" id="tests_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>اسم الفحص</th>
                                    <th>وصف الدواء</th>
                                    <th>السعر</th>
                                    <th>ملف الفحص</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="checkbox_{{ $test->id }}" name="tests_id[]" value="{{$test->id}}" class="form-control" >
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="name">
                                            <a href="{{ route('laboratory.edit', $test->id) }}"
                                                class="nav-item">{{ $test->name_test }}</a>
                                        </td>
                                        <td>{{ $test->description }}</td>
                                        <td class="price" id="price_{{$test->id}}">{{ $test->price }}</td>
                                        <td>
                                            @if ($test->file_test_url)
                                                <a href="{{$test->file_test_url}}" download>تحميل</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Striped rows -->
        </form>
    </div>

    {{-- modal --}}
    @if (isset($editItem))
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل تريد حذف الفاتورة صاحبة الرقم : {{$reservation->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{route('laboratory.destroy',$reservation->id)}}" method="POST">
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
    <script>
        const csrf_token = "{{ csrf_token() }}";
        const app_link = "{{ config('app.url') }}";
    </script>
    <script src="{{ asset('js-custom/sendChecked.js') }}"></script>
    @endpush
</x-front-layout>
