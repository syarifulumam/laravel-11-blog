<x-app-layout>
    {{ Breadcrumbs::render('home') }}
    <section class="p-2 sm:ml-64">
        <div class="mx-auto max-w-screen-xl px-2 columns-3">
            <a href="#"
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Articles</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $articles }}</p>
            </a>
            <a href="#"
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Categories</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $categories }}</p>
            </a>
            <a href="#"
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Users</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $users }}</p>
            </a>
        </div>
    </section>
</x-app-layout>
