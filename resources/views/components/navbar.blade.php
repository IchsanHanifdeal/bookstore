@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Request;
    use App\Models\Customer;
    use App\Models\Keranjang;

    $jumlah_cart = 0;

    if (Auth::check()) {
        $user = Auth::user();
        $customer = Customer::where('user', $user->id)->first();

        if ($customer) {
            $jumlah_cart = Keranjang::where('customer', $customer->id)->count();
        }
    }
@endphp

<nav class="navbar bg-white shadow-md px-4 text-black">
    <div class="flex-1">
        <a href="{{ route('index') }}" class="btn btn-ghost normal-case text-xl">
            <span class="font-bold text-black px-2 py-1 rounded-md">SYAHBIL FIRDAUS BERKARYA</span>
        </a>
    </div>
    <div class="flex-none">
        @auth
            <ul class="menu menu-horizontal px-1">
                <li>
                    <a href="{{ route('index') }}" 
                        class="font-medium {{ Request::routeIs('index') ? 'text-blue-600 font-bold' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('keranjang') }}" 
                        class="font-medium {{ Request::routeIs('keranjang') ? 'text-blue-600 font-bold' : '' }}">
                        Keranjang ({{ $jumlah_cart }})
                    </a>
                </li>
            </ul>
            <button type="submit" class="btn btn-sm btn-outline"
                onclick="document.getElementById('logout_modal').showModal();">Logout</button>
        @else
            <ul class="menu menu-horizontal px-1">
                <li>
                    <a href="{{ route('index') }}" 
                        class="font-medium {{ Request::routeIs('index') ? 'text-blue-600 font-bold' : '' }}">
                        Home
                    </a>
                </li>
            </ul>
            <div class="flex gap-2">
                <a href="{{ route('login') }}" 
                    class="btn btn-sm btn-outline {{ Request::routeIs('login') ? 'btn-primary' : '' }}">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                    class="btn btn-sm btn-outline {{ Request::routeIs('register') ? 'btn-primary' : '' }}">
                    Register
                </a>
            </div>
        @endauth
    </div>
</nav>

<dialog id="logout_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box rounded-xl shadow-lg">
        <h3 class="text-xl font-bold text-gray-800">Konfirmasi Logout</h3>
        <p class="mt-2 text-gray-600">Apakah Anda yakin ingin keluar?</p>
        <div class="modal-action mt-4">
            <button type="button" onclick="document.getElementById('logout_modal').close()"
                class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 border-0">
                Batal
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary bg-red-600 hover:bg-red-700 text-white border-0"
                    onclick="closeAllModals(event)">
                    Logout
                </button>
            </form>
        </div>
    </div>
</dialog>

<script>
    function closeAllModals(event) {
        const form = event.target.closest('form');

        if (form) {
            form.submit();

            const modals = document.querySelectorAll('dialog.modal');

            modals.forEach(modal => {
                if (modal.hasAttribute('open')) {
                    modal.close();
                }
            });
        }
    }
</script>
