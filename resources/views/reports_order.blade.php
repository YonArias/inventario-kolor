<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto py-6 px-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex items-center mb-4 flex-auto">
                <label for="date" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Fecha: </label>
                <input type="text" id="date" name="date" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $order->created_at }}" disabled>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="voucher" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Comprobante: </label>
                <input type="text" id="voucher" name="voucher" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $voucher }}" disabled>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="supplier" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Proveedor: </label>
                <input type="text" id="supplier" name="supplier" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $supplier->title }}" disabled>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="user" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Usuario: </label>
                <input type="text" id="user" name="user" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $user->name }}" disabled>
            </div>
        </div>
        <div class="">
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
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach ($details as $detail)
                        @if ($order->id == $detail->order_id)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    {{ $i }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @foreach ($products as $product)
                                        @if ($detail->product_id == $product->id)
                                            00{{ $product->id }}
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
                            </tr>
                            @php $i += 1 @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex mt-6">
            <div class="flex items-center mb-4">
                <label for="total" class="block w-2/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Total: S/. </label>
                <input type="text" id="total" name="total" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $order->price_total }}" disabled>
            </div>
        </div>
        <div class="flex justify-end">
            <form action="/warehouse/orders/{{ $order->id }}" method="POST" class="mr-6">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Anular Compra
                </button>
            </form>
            <a href="/reports/2" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 self-end">Regresar</a>
        </div>
    </div>
</x-app-layout>