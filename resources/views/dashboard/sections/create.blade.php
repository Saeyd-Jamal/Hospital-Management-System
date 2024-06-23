<x-front-layout>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="h5 page-title">إضافة قسم جديد للمستشفى</h2>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('sections.store') }}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @include('dashboard.sections._from')
        </form>
    </div>


</x-front-layout>
