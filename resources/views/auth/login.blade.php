@include('layout.partials.head')
<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST"  action="{{ route('login') }}">
            @csrf
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
            <h1 class="h6 mb-3">تسجيل الدخول</h1>
            {{Config::get('fortify.guard')}}
            <div class="form-group">
                <label for="username" class="sr-only">اسم المستخدم</label>
                <input type="text" id="username" class="form-control form-control-lg"
                    placeholder="أكتب اسم المستخدم" name="username" required autofocus value="{{ old('username') }}">
                <x-input-error :messages="$errors->get('username')" class="mt-2" />

            </div>
            <div class="form-group">
                <label for="password" class="sr-only">كلمة المرور</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                    placeholder="إملأ كلمة المرور" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل الدخول</button>
            <p class="mt-5 mb-3 text-muted">إنتاج المهندس : السيد الاخرس</p>
        </form>
    </div>
</div>
@include('layout.partials.footer')
