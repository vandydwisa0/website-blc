@extends('admin.layouts.app')
@section('content')
    <div class="sm:ml-64">
        <div class="p-4 py-10 mt-14">
            <h1 class="mb-2 text-gray-700 font-bold text-4xl">Data Guru</h1>

            <section class="bg-gray-50 ">
                <div class="flex-auto mx-auto">
                    <!-- Start coding here -->
                    <div class="bg-white relative overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-row">
                                            <input type="text" id="cari" name="cari" {{-- value="{{ request('cari') }}" --}}
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2    -500 -500"
                                                placeholder="Search" name="search">
                                            {{-- <button type="submit" class=" ml-4 block w-full md:w-auto font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white bg-dwisa-400 hover:bg-dwisa-300 focus:ring-dwisa-300  -200 -300">Cari</button> --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                                @include('admin.guru.create')

                            </div>
                        </div>
                        <div class="bg-white relative px-4 py-4 overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-500 ">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">No</th>
                                        <th scope="col" class="px-4 py-3 text-center">Foto</th>
                                        <th scope="col" class="px-4 py-3">Nama</th>
                                        <th scope="col" class="px-4 py-3">Spesialisasi</th>
                                        <th scope="col" class="px-4 py-3">Riwayat Pendidikan</th>
                                        <th scope="col" class="px-4 py-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($guru as $item)
                                        <tr class="border-b">
                                            <th scope="row" class="px-4 py-3">{{ $loop->iteration }}</th>
                                            {{-- <td class="px-4 py-3">
                                                <div style="display: flex; justify-content: center;">
                                                    @if ($item->data()['photo'])
                                                        <img src="{{ asset('storage/' . $item->data()['photo']) }}"
                                                            alt="Photo Guru" class="w-24 h-28 rounded-full">
                                                    @else
                                                        <span>No Photo</span>
                                                    @endif
                                            </td> --}}
                                            <td class="px-4 py-3">
                                                <div style="display: flex; justify-content: center;">
                                                    @if ($item->data()['photo'])
                                                        <img src="{{ $item->data()['photo'] }}" alt="Photo Guru"
                                                            class="w-24 h-28 rounded-full">
                                                    @else
                                                        <span>No Photo</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-4 py-3">{{ $item->data()['name'] }}</td>
                                            <td class="px-4 py-3">{{ $item->data()['specialization'] }}</td>
                                            <td class="px-4 py-3">
                                                @if (!empty($item->data()['education']))
                                                    @foreach ($item->data()['education'] as $education)
                                                        @foreach (explode(PHP_EOL, $education) as $edu)
                                                            {{ $edu }}<br>
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    <span>No Education</span>
                                                @endif
                                            </td>

                                            <td class="flex px-6 py-4 items-center justify-center">
                                                @include('admin.guru.edit')
                                                @include('admin.guru.delete')
                                                {{-- @include('admin.guru.show') --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- PAGINATION --}}
                        {{-- {{ $guru->links('vendor.pagination.tailwind') }} --}}
                    </div>
                </div>
            </section>


        </div>
    </div>
@endsection
