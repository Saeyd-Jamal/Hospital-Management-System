<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('home')}}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>عام</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{route('reservations.create')}}">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">الإستقبال</span>
                    <span class="badge badge-pill badge-primary">+</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#reservations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">الحجوزات</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="reservations">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('reservations.index') }}">
                            <span class="ml-1 item-text">عرض الحجوزات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('reservations.create') }}">
                            <span class="ml-1 item-text">إضافة حجز +</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#pharmacy" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">الصيدلية</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pharmacy">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('pharmacy.index') }}">
                            <span class="ml-1 item-text">عرض الفواتير</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('pharmacy.create') }}">
                            <span class="ml-1 item-text">إضافة فاتورة +</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('pharmacy.reservation') }}">
                            <span class="ml-1 item-text">عرض الحجوزات</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#laboratory_view" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">المختبر</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="laboratory_view">
                    <li class="nav-item dropdown">
                        <a href="#laboratory_tests" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-credit-card fe-16"></i>
                            <span class="ml-3 item-text">فحوصات المختبر</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="laboratory_tests">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('laboratory_tests.index') }}">
                                    <span class="ml-1 item-text">عرض</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('laboratory_tests.create') }}">
                                    <span class="ml-1 item-text">إضافة</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#">
                                    <span class="ml-1 item-text">سلة المحذوفات</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#laboratory" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-credit-card fe-16"></i>
                            <span class="ml-3 item-text">حجوزات المختبر</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="laboratory">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('laboratory.index') }}">
                                    <span class="ml-1 item-text">عرض</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('laboratory.create') }}">
                                    <span class="ml-1 item-text">إضافة</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#">
                                    <span class="ml-1 item-text">سلة المحذوفات</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>الإدارة</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#sections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">الأقسام</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="sections">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('sections.index') }}">
                            <span class="ml-1 item-text">عرض</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('sections.create') }}">
                            <span class="ml-1 item-text">إضافة</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#">
                            <span class="ml-1 item-text">سلة المحذوفات</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#doctors" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">الأطباء</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="doctors">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('doctors.index') }}">
                            <span class="ml-1 item-text">عرض</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('doctors.create') }}">
                            <span class="ml-1 item-text">إضافة</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#">
                            <span class="ml-1 item-text">سلة المحذوفات</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#patients" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">سجلات المرضى</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="patients">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('patients.index') }}">
                            <span class="ml-1 item-text">عرض</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('patients.create') }}">
                            <span class="ml-1 item-text">إضافة</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#">
                            <span class="ml-1 item-text">سلة المحذوفات</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#medicines" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">مخزن الأدوية</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="medicines">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('medicines.index') }}">
                            <span class="ml-1 item-text">عرض</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('medicines.create') }}">
                            <span class="ml-1 item-text">إضافة</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#">
                            <span class="ml-1 item-text">سلة المحذوفات</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

        {{-- for example --}}
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>الإدارة</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="widgets.html">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">صفحة</span>
                    <span class="badge badge-pill badge-primary">1</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">قائمة</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_elements.html"><span class="ml-1 item-text">Basic
                                Elements</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_advanced.html"><span class="ml-1 item-text">Advanced
                                Elements</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_validation.html"><span
                                class="ml-1 item-text">Validation</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_wizard.html"><span
                                class="ml-1 item-text">Wizard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_layouts.html"><span
                                class="ml-1 item-text">Layouts</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_upload.html"><span class="ml-1 item-text">File
                                upload</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
