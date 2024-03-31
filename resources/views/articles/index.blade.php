<x-app-layout>
    <x-breadcrumb />
    <section class="p-2 sm:ml-64">
        <div class="mx-auto max-w-screen-xl px-2 ">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <x-icons.search />
                                </div>
                                <x-text-input id="simple-search" class="block w-full pl-10 p-2" type="text"
                                    name="search" :value="old('search')" />
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <x-primary-button as="a" href="{{ route('article.create') }}">Add
                            Article</x-primary-button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-24 py-3">Title</th>
                                <th scope="col" class="py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-24 py-3">{{ $article->title }}</td>
                                    <td class="py-3">
                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <a href="{{ route('article.edit', $article->id) }}">
                                                <x-button-group class="rounded-s-lg"><x-icons.edit /></x-button-group>
                                            </a>
                                            <x-button-group class="rounded-e-lg" data-modal-target="popup-modal-{{ $article->id }}" data-modal-toggle="popup-modal-{{ $article->id }}">
                                                <x-icons.trash />
                                            </x-button-group>
                                            <x-modal-delete route="{{ route('article.destroy', $article->id) }}" id="{{ $article->id }}"/>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    {{ $articles->links() }}
                </nav>
            </div>
        </div>
    </section>
    <x-form-modal route='category.store' id="crud-modal" />
    @if (session()->has('message'))
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 fixed top-5 right-5 z-50 border border-green-300 bg-green-50"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @push('custom-scripts')
        <script>
            // Toast duration close
            const targetElement = document.getElementById('toast-success');

            function hideElement() {
                targetElement.classList.add('hidden');
                setTimeout(() => {
                    targetElement.style.display = 'none';
                }, 1000);
            }
            setTimeout(hideElement, 2000);
        </script>
    @endpush
</x-app-layout>
