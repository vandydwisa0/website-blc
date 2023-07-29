<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2">


            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100
            {{ request()->is('admin/dashboard') ? 'bg-green-300 text-black ' : '' }}">
                    <box-icon type='solid' name='dashboard'></box-icon>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}"
                    class="flex items-center p-2 text-base font-normal text-black rounded-lg hover:bg-gray-100
            {{ request()->is('admin/users') ? 'bg-green-300 text-black ' : '' }}">
                    <box-icon type='solid' name='user'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Staff</span>
                </a>
            </li>

            <li>
                <a href="{{ route('siswa.index') }}"
                    class="flex items-center p-2 text-base font-normal text-black rounded-lg hover:bg-gray-100
            {{ request()->is('admin/siswa') ? 'bg-green-300 text-black ' : '' }}">
                    <box-icon type='solid' name='user'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Siswa</span>
                </a>
            </li>

            <li>
                <a href="{{ route('program.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
            {{ request()->is('admin/program') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='server'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Program</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('jadwal.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
            {{ request()->is('admin/jadwal') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='server'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Jadwal</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('cabang.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
            {{ request()->is('admin/cabang') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='server'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Cabang</span>
                </a>
            </li>

            <li>
                <a href="{{ route('kelas.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
            {{ request()->is('admin/kelas') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='server'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kelas</span>
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('guru.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
            {{ request()->is('admin/guru') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='server'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Guru</span>
                </a>
            </li> --}}

            <li>
                <a href="{{ route('pembayaranpendaftaran.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
             {{ request()->is('admin/pembayaranpendaftaran') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='wallet'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pembayaran Pendaftaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pembayaran.index') }}"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100
             {{ request()->is('admin/pembayaran') ? 'bg-green-300 text-black' : '' }}">
                    <box-icon type='solid' name='wallet'></box-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pembayaran</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
