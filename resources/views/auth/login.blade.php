@extends('auth.app')
@section('content')
    <div class="flex justify-center my-24">
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            <div class="p-6 space-y-4 md:space-y-20 sm:p-8 drop-shadow-lg">
                <a href="#" class="flex justify-center drop-shadow-lg items-center text-2xl font-semibold text-black">
                    <img class="w-2/12 h-2/12 drop-shadow-lg" src="../images/blc.png">
                    Log in
                </a>
                <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="text" name="nik" id="nik"
                            class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="nik@blc.com" required="">
                    </div>
                    <div>
                        <label for="nip" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="nip" id="nip" placeholder="••••••••"
                            class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                    </div>
                    <div class="py-4">

                        <button type="submit" style="background-color: #539165"
                            class="w-full text-white focus:ring-4 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-gray-400">Log
                            in</button>
                        @if (session('success'))
                            <script>
                                swal("Success", "{{ session('success') }}", "success");
                            </script>
                        @endif

                        @if (session('error'))
                            <script>
                                swal("Error", "{{ session('error') }}", "error");
                            </script>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    @endsection
