<aside class="flex flex-col md:flex-row">
    <nav aria-label="alternative nav">
        <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

            <div class="md:mt-40 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-3 text-center md:text-left">
                    @auth
                        <li class="mr-3 flex-1">
                            <a href="{{ route('dashboard') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white {{ request()->is('dashboard') ? 'border-b-2 border-pink-600' : 'border-b-2 border-gray-800' }}">
                                <i class="fa-solid fa-tv md:pr-3 pr-0"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Dashboard</span>
                            </a>
                        </li>
                    @endauth
                    <li class="flex-1 md:flex-none mr-3">
                        <div class="relative">
                            <button onclick="toggleDD('myDropdownSidebar')" class="drop-button block py-1 md:py-3 pl-1 align-middle text-white hover:text-white {{ request()->is('budidaya/sudah-panen') ||  request()->is('budidaya/belum-panen')  ? 'border-b-2 border-green-500' : 'border-b-2 border-gray-800' }}">
                                <i class="fa-solid fa-fish-fins md:pr-3 pr-1"></i>Budidaya<i class="fa-solid fa-caret-down pl-2"></i>
                            </button>
                        
                            <div id="myDropdownSidebar" class="dropdownlist flex md:flex-col flex-row bg-gray-800 text-white  p-2 overflow-auto z-30 invisible">
                                <a href={{ route('budidaya.index.sudah.panen') }} class="md:block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white "><i class="pr-0 md:pr-3 fa-solid fa-check"></i>Sudah panen</a>
                                <a href={{ route('budidaya.index.belum.panen') }} class="md:block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white"><i class="pr-0 md:pr-3 fa-regular fa-circle-xmark"></i>Belum panen</a>
                            </div>
                        </div>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="/" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white {{ request()->is('/') ? 'border-b-2 border-blue-600' : 'border-b-2 border-gray-800' }}">
                            <i class="fas fa-chart-area pr-0 md:pr-3 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Feeding Methods</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</aside>
