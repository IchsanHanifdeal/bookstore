<x-main title="Masuk" class="p-0" full>
    <section class="min-h-screen flex items-stretch text-white ">
        <div
            class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center bg-[url('https://images.pexels.com/photos/256455/pexels-photo-256455.jpeg')]">
            <div class="absolute bg-[linear-gradient(180deg,transparent,rgba(0,0,0,1))] inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <p class="text-4xl leading-tight tracking-wide font-semibold max-w-lg">Solusi kebutuhan buku untuk
                    operasional bisnis Anda.</p>
            </div>
            <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4">
                <span>
                    @include('components.brands')
                </span>
            </div>
        </div>
        <div class="lg:w-1/2 bg-[#161616] w-full flex items-center justify-center text-center md:px-16 px-0 z-0">
            <div
                class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center bg-[url('https://www.hashmicro.com/id/blog/wp-content/uploads/2022/10/image-25-1.jpg')]">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="my-6">
                    @include('components.brands', ['class' => '!text-3xl'])
                </h1>
                <form action="{{ route('authenticate') }}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto" method="POST">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input type="text" name="username" id="username" required placeholder="Masukkan username..."
                            class="input block w-full p-4 text-lg bg-gray-700">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="input block w-full p-4 text-lg bg-gray-700" type="password" name="password"
                            id="password" required placeholder="Masukkan password...">
                    </div>
                    <div class="pb-2 pt-4">
                        <button type="submit" class="btn w-full">Masuk</button>
                    </div>
                    <div class="pb-2 pt-4">
                        <a href="{{ route('index') }}" class="btn w-full">Kembali</a>
                    </div>
                </form>
                <h1 class="mt-5 text-sm opacity-50">Belum punya akun?
                    <a href="{{ route('register') }}" class="hover:underline">Daftar Akun</a>
                </h1>
            </div>
        </div>
    </section>
</x-main>
