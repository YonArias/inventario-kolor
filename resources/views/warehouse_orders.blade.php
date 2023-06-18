<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto py-6 px-16 sm:px-6 lg:px-8">
        <form class="mb-6 flex flex-col items-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" action="/warehouse/orders" method="POST">
            @csrf
            <div class="flex items-center w-full">
                <div class="flex items-center mr-4 w-3/5">
                    <label for="p_name" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Producto: </label>
                    <select id="product" name="product" class="w-4/5 bg-gray-50 ml-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center w-2/5">
                    <label for="p_amount" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Cantidad: </label>
                    <input type="number" id="amount" name="amount" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required min="0"
                    >
                </div>
                <div class="flex items-center w-2/5">
                    <label for="p_price" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                    <input type="number" id="price" name="price" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="S/. 0" required>
                </div>
                <div class="">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
                </div>
            </div>
            <div class="w-full flex items-end mt-4">
                <a href="/warehouse/create/{{ $order_id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear producto</a>
            </div>
        </form>
        <div class="mb-24">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Codigo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio Unitario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @php $total = 0 @endphp
                    @foreach ($details as $detail)
                        @if ($order_id == $detail->order_id)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    {{ $i }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @foreach ($products as $product)
                                        @if ($detail->product_id == $product->id)
                                            {{ $product->id }}
                                        @endif
                                    @endforeach
                                </th>
                                <td class="px-6 py-4">
                                    @foreach ($products as $product)
                                        @if ($detail->product_id == $product->id)
                                            {{ $product->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $detail->amount }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($products as $product)
                                        @if ($detail->product_id == $product->id)
                                            {{ $product->price }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $detail->sub_total }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="/detail_order/delete/{{ $detail->id }}">
                                        <button >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @php $total = $total + $detail->sub_total @endphp
                            @php $i += 1 @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <form class="flex flex-col" action="/warehouse/orders/{{ $order_id }}" method="POST">
            @method('PATCH')
            @csrf

            <div class="flex items-center mb-4 ml-auto">
                <label for="total" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Total: </label>
                <input type="number" id="total" name="total" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $total }}" required>
            </div>
            <div class="mb-6 items-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-sm font-medium text-gray-900 dark:text-white mb-4">
                    Datos de proveedor
                </div>
                <div class="flex">
                    <div class="flex items-center w-3/5">
                        <label for="supplier" class="block w-1/5 mr-1 text-sm font-medium text-gray-900 dark:text-white">Razon Social: </label>
                        <select id="supplier" name="supplier" class="w-3/5 bg-gray-50 mr-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center w-2/5">
                        <label for="ruc" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">RUC: </label>
                        <input type="text" id="ruc" name="ruc" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled required>
                    </div>
                    <div class="flex items-center w-3/5">
                        <label for="address" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Direccion: </label>
                        <input type="text" id="address" name="address" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled required>
                    </div>
                </div>
                <div class="w-full mt-4">
                    <a href="/supplier/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 self-end ">
                        Crear Proveedor
                    </a>
                </div>
            </div>
            <div class="w-full grid gap-6 mb-6 md:grid-cols-2">
                <div class="flex items-center mb-4 flex-auto">
                    <label for="p_name" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Fecha: </label>
                    <input type="date" id="date" name="date" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                </div>
                <div class="flex items-center mb-4 flex-auto">
                    <label for="voucher" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Comprobante: </label>
                    <select id="voucher" name="voucher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" >FACTURA</option>
                        <option value="2" >BOLETA</option>
                        <option value="3" >NONE</option>
                      </select>
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 self-end">Confirmar</button>
        </form>

        <div class="flex justify-end w-full">
            <form action="/warehouse/orders/{{ $order_id }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
            </form>
        </div>
    </div>
    
    

</x-app-layout>
