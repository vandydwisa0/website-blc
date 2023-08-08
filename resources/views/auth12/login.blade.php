@extends('layouts.app')

@section('content')
    <<div class="flex justify-center my-24">
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            <div class="p-6 space-y-4 md:space-y-20 sm:p-8 drop-shadow-lg">
                <a href="#" class="flex justify-center drop-shadow-lg items-center text-2xl font-semibold text-black">
                    <img class="w-2/12 h-2/12 drop-shadow-lg" src="../images/blc.png">
                    Log in
                </a>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">
                            NIK:
                        </label>

                        <input id="nik" type="text"
                            class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('nik') border-red-500 @enderror"
                            name="email" value="dummy1@blc.com" required autocomplete="nik" autofocus>

                        @error('nik')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                            NIP:
                        </label>

                        <input id="password" type="password" value="testing123"
                            class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('password') border-red-500 @enderror"
                            name="password" required>

                        @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="py-4">
                        <button type="submit"
                            class="w-full text-white focus:ring-4 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-gray-400">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>

                </section>
            </div>
        </div>
        </main>
    @endsection
