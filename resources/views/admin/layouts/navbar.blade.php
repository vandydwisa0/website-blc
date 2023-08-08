    <nav class="fixed top-0 z-50 w-full " style="background-color: #539165">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 ">
                        <box-icon name='menu'></box-icon>
                    </button>
                    <img src="../images/blc.png" class="h-auto w-10 mr-3" />
                    <span
                        class="self-center text-xl text-white font-medium sm:text-2xl whitespace-nowrap dark:text-white">BLC</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div>
                            <button type="button" class="flex justify-end text-sm ml-10" aria-expanded="false"
                                data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-2/12 h-2/12 justify-center drop-shadow-sm" src="../images/image5.png">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    Selamat datang
                                    {{ Session::get('name') }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 "
                                        role="menuitem"
                                        onclick="event.preventDefault(); document.getElementById('login').submit();">
                                        Logout
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" hidden class="none"
                                        id="login">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
