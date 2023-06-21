<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto py-6 px-16 sm:px-6 lg:px-8">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="/reports/{{ 1 }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-4">
                            <path d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3a65.25 65.25 0 0113.36 1.412.75.75 0 01.58.875 48.645 48.645 0 01-1.618 6.2.75.75 0 01-.712.513H6a2.503 2.503 0 00-2.292 1.5H17.25a.75.75 0 010 1.5H2.76a.75.75 0 01-.748-.807 4.002 4.002 0 012.716-3.486L3.626 2.716a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM6 17.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                          </svg>
                          Reportes de Ventas
                    </a>
                </li>
                <li class="mr-2">
                    <a href="/reports/{{ 2 }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-4">
                            <path fill-rule="evenodd" d="M18 5.25a2.25 2.25 0 00-2.012-2.238A2.25 2.25 0 0013.75 1h-1.5a2.25 2.25 0 00-2.238 2.012c-.875.092-1.6.686-1.884 1.488H11A2.5 2.5 0 0113.5 7v7h2.25A2.25 2.25 0 0018 11.75v-6.5zM12.25 2.5a.75.75 0 00-.75.75v.25h3v-.25a.75.75 0 00-.75-.75h-1.5z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M3 6a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H3zm6.874 4.166a.75.75 0 10-1.248-.832l-2.493 3.739-.853-.853a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.154-.114l3-4.5z" clip-rule="evenodd" />
                          </svg>
                          Reportes de Compras
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="hidden">
            <input type="text" id="supplier" >
        </div>
        <div class="">
            @if ($table == 1)
                <table id="table-venta" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                    <caption class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Reportes de Ventas</caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Fecha y Hora
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Monto Total
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No. Productos
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Vendedor
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Accion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0
                        @endphp
                        @foreach ($sales as $sale)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    {{ $i = $i + 1 }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $sale->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->total }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $count = 0
                                    @endphp
                                    @foreach ($sales_details as $sale_detail)
                                        @if ($sale_detail->sale_id == $sale->id)
                                            @php
                                                $count = $count + 1
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{ $count }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($users as $user)
                                        @if ($user->id == $sale->user_id)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <form action="/sales/{{ $sale->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm(' ¿Seguro que quieres eliminar la venta? ')" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if ($table == 2)
                <table id="table-compra" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                    <caption class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Reportes de Compras</caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Fecha y Hora
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Monto total
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                No. Productos
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Proveedor
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Accion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0
                        @endphp
                        @foreach ($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    {{ $i = $i + 1 }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $order->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->price_total }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $count = 0
                                    @endphp
                                    @foreach ($orders_details as $order_detail)
                                        @if ($order_detail->order_id == $order->id)
                                            @php
                                                $count = $count + 1
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{ $count }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($suppliers as $supplier)
                                        @if ($supplier->id == $order->supplier_id)
                                            {{ $supplier->title }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    <form action="/warehouse/orders/{{ $sale->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm(' ¿Seguro que quieres eliminar el orden de compra? ')" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>