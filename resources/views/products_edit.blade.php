<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto py-6 px-16 sm:px-6 lg:px-8">
        <form action="/warehouse/{{$product->id}}" class="px-72 mt-6" method="POST">
            @method('PATCH')
            @csrf
            <div class="flex items-center mb-4 flex-auto">
                <label for="model" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Modelo: </label>
                <input type="text" id="model" name="model" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $product->model }}" required>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="mark" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Marca: </label>
                <select id="mark" name="mark" class="block w-3/5 bg-gray-50 mr-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    @foreach ($marks as $mark)
                        @if ($product->mark_id == $mark->id)
                            <option value="{{ $mark->id }}" selected>{{ $mark->name }}</option>
                        @else
                            <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="category" class="block w-1/5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Categoria: </label>
                <select id="category" name="category" class="w-3/5 bg-gray-50 mr-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    @foreach ($categories as $category)
                        @if ($product->category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="price" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Precio: </label>
                <input type="number" id="price" name="price" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $product->price }}" required>
            </div>
            <div class="flex items-center mb-4 flex-auto">
                <label for="description" class="block w-1/5 mb-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Descripcion: </label>
                <textarea id="description" name="description" class="mr-4 block w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>{{ $product->description }}
                </textarea>
            </div>
            <div>
                <button type="submit" class="mt-6 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>