    <nav class="fixed top-0 z-50 w-full" style="background-color: #539165">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    {{-- <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-white dark:focus:ring-white">
                        <box-icon name='menu'></box-icon>
                    </button> --}}
                    <img src="../images/blc.png" class="h-auto w-10 mr-3" />
                    <span class="self-center text-xl text-white font-medium sm:text-2xl whitespace-nowrap">BLC</span>
                    </a>
                </div>
                <div class="flex items-center lg:order-2">
                    <a href="{{ route('login') }}"
                        class="text-white text-lg hover:bg-green hover:text-white focus:ring-4 focus:ring-white font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2">Log
                        in</a>
                </div>
            </div>
    </nav>
