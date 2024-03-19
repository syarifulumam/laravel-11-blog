<x-app-layout>
    <x-breadcrumb />
    <div class="p-4 sm:ml-64">
        <div class="p-4  rounded-lg bg-white dark:bg-gray-800 ">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Category</h2>
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" value="{{ old('title', $category->title) }}" name="title" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            >
                    </div>
                </div>
                <button type="submit"
                    class=" mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
        </form>
    </div>
    </div>
</x-app-layout>
