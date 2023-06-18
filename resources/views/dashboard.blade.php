<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto py-6 px-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 mb-6 md:grid-cols-4 ">
            <a href="/sales/create" class="grid gap-6 mb-6 md:grid-cols-2 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 items-centers px-4 py-4">
                <div class="w-auto rounded-t-lg h-96 md:h-auto md:w-24 md:rounded-none md:rounded-l-lg m-auto">
                    <svg class="stroke-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>                  
                </div>
                <div class="flex flex-col items-center p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ count($sales) }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Ventas</p>
                </div>
            </a>
            <a href="/warehouse" class="grid gap-6 mb-6 md:grid-cols-2 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 items-centers px-4 py-4">
                <div class="w-auto rounded-t-lg h-96 md:h-auto md:w-24 md:rounded-none md:rounded-l-lg m-auto">
                    <svg class="stroke-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>                                  
                </div>
                <div class="flex flex-col items-center p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ count($products) }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Productos</p>
                </div>
            </a>
            <a href="/reports" class="grid gap-6 mb-6 md:grid-cols-2 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 items-centers px-4 py-4">
                <div class="w-auto rounded-t-lg h-96 md:h-auto md:w-24 md:rounded-none md:rounded-l-lg m-auto">
                    <svg class="stroke-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>                                   
                </div>
                <div class="flex flex-col items-center p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">#</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Reportes</p>
                </div>
            </a>
            <a href="/users" class="grid gap-6 mb-6 md:grid-cols-2 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 items-centers px-4 py-4">
                <div class="w-auto rounded-t-lg h-96 md:h-auto md:w-24 md:rounded-none md:rounded-l-lg m-auto">
                    <svg class="stroke-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>                                                    
                </div>
                <div class="flex flex-col items-center p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ count($users) }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Usuarios</p>
                </div>
            </a>
        </div>

        <div class="grid gap-12 mb-6 md:grid-cols-2">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">Productos Agotados</caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            -
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fechaActual = date('Y-m-d');
                        $i = 1
                    @endphp
                    @foreach ($products as $product)
                        @if ($product->stock == 0)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    {{ $i }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->price }}
                                </td>
                                <td class="px-6 py-4">
                                </td>
                            </tr>
                            @php $i += 1 @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            </table>
        </div>
    </div>
</x-app-layout>
