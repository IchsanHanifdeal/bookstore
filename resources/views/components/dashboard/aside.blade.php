<div class="drawer-side border-r z-20">
    <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu p-4 w-64 lg:w-72 min-h-full bg-white [&>li>a]:gap-4 [&>li]:my-1.5 [&>li]:text-[14.3px] [&>li]:font-medium [&>li]:text-opacity-80 [&>li]:text-base [&>_*_svg]:stroke-[1.5] [&>_*_svg]:size-[23px] [&>.label]:mt-6">
        
        <!-- Brand Section -->
        <div class="pb-4 border-b border-gray-300">
            @include('components.brands', ['class' => '!text-xl'])
        </div>
        
        <!-- General Section -->
        <span class="label text-xs font-extrabold opacity-50">GENERAL</span>
        <li>
            <a href="{{ route('dashboard') }}" class="{!! Request::path() == 'dashboard' ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-bar-chart-2 />
                Dashboard
            </a>
        </li>

        <span class="label text-xs font-extrabold opacity-50 mt-4">DATA</span>
        <li>
            <a href="{{ route('buku') }}" class="{!! Request::is('dashboard/buku*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-book />
                Data Buku
            </a>
        </li>
        <li>
            <a href="{{ route('customer') }}" class="{!! Request::is('dashboard/customer*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-users />
                Data Customer
            </a>
        </li>
        <li>
            <a href="{{ route('kategori') }}" class="{!! Request::is('dashboard/kategori*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-list />
                Data Kategori
            </a>
        </li>
        <li>
            <a href="{{ route('penerbit') }}" class="{!! Request::is('dashboard/penerbit*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-building />
                Data Penerbit
            </a>
        </li>
        <li>
            <a href="{{ route('pengarang') }}" class="{!! Request::is('dashboard/pengarang*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-pencil />
                Data Pengarang
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi') }}" class="{!! Request::is('dashboard/transaksi*') ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-shopping-cart />
                Data Transaksi
            </a>
        </li>

        <!-- Logout Section -->
        <span class="label text-xs font-extrabold opacity-50 mt-4">ADVANCE</span>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="px-0">
                @csrf
                <a class="flex items-center px-2.5 gap-4" href="#" onclick="event.preventDefault(); confirmLogout();">
                    <x-lucide-log-out />
                    Logout
                </a>
            </form>
        </li>
    </ul>
</div>
