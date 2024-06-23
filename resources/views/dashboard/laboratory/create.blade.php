<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">إنشاء فاتورة جديدة للصيدلية</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('laboratory.store') }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @include('dashboard.laboratory._from')
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group col-md-3">
                                <x-form.input name='searchInp' label='البحث عن فحص' placeholder="" />
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
    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
            const app_link = "{{ config('app.url') }}";
        </script>
        <script src="{{ asset('js-custom/sendCheckedLab.js') }}"></script>
    @endpush
</x-front-layout>
