@extends('admin.layouts.app')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <section class="bg-white">
                <div class="max-w-screen-xl px-4 p-8 mx-auto text-center lg:px-6">
                    <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-5 ">
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-between">
                                <div class="pt-3 pr-2"><box-icon type='solid' name='user'></box-icon></div>
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $numberOfUsers }}</dt>
                            </div>
                            <dd class="font-light text-gray-500">Jumlah Petugas</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-between">
                                <div class="pt-3 pr-2"><box-icon type='solid' name='group'></box-icon></div>
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $numberOfSiswa }}</dt>
                            </div>
                            <dd class="font-light text-gray-500">Jumlah Siswa</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-between">
                                <div class="pt-3 pr-2"><box-icon type='solid' name='collection'></box-icon></div>
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $numberOfKelas }}</dt>
                            </div>
                            <dd class="font-light text-gray-500">Jumlah Kelas</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-between">
                                <div class="pt-3 pr-2"><box-icon type='solid' name='server'></box-icon></div>
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $numberOfProgram }}</dt>
                            </div>
                            <dd class="font-light text-gray-500">Jumlah Program</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-between">
                                <div class="pt-3 pr-2"><box-icon type='solid' name='institution'></box-icon></div>
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $numberOfCabang }}</dt>
                            </div>
                            <dd class="font-light text-gray-500">Jumlah Cabang</dd>
                        </div>
                    </dl>
                </div>
            </section>
            <div class="flex flex-row items-center justify-between h-auto rounded mx-auto lg:py-10 bg-white">
                <img class="h-auto w-1/3 mx-auto drop-shadow-md" src="../images/image1.png">
                <div class="p-7 mx-8 space-y-4 md:space-y-5 drop-shadow-sm">
                    <p class="text-gray-900 font-light text-4xl">Welcome {{ Session::get('role') }}</p>
                    <p class="text-gray-900 font-light text-5xl">{{ Session::get('name') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
