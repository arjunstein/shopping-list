<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">{{ $title ?? 'Page title' }}</h2>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 gap-4">
            <form class="w-full sm:w-auto">
                <input type="search" wire:model.live="search" placeholder="Search category..." autocomplete="off"
                    class="w-full sm:w-96 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </form>

            <a href="{{ route('category-create') }}" wire:navigate
                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">Add
                Category
            </a>
        </div>

        <div class="overflow-x-auto py-2">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Image</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Description</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Created at</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($categories as $i => $category)
                        <tr>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                <img src="{{ $category->image ? asset('storage/categories/' . $category->image) : 'https://i.pravatar.cc/50' }}"
                                    class="w-10 h-10 rounded-full" alt="{{ $category->name }}">
                            </td>
                            <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                {{ $category->description ? $category->description : '-' }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $category->created_at }}</td>
                            <td class="px-4 py-3 space-x-2 flex">
                                <button type="button" data-modal-target="showCategory" data-modal-toggle="showCategory"
                                    wire:click="showDetailCategory('{{ $category->id }}')"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-purple-600 text-white rounded hover:bg-purple-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <a href="{{ route('category-edit', $category->id) }}" wire:navigate title="Edit"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-green-600 text-white rounded hover:bg-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11.5a.5.5 0 00.5.5H16a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>

                                <button wire:click="deleteCategory('{{ $category->id }}')" title="Delete"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-red-600 text-white rounded hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                    </svg>
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Category
                                not found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Main modal detail category -->
    <div>
        <div x-cloak x-show="$wire.showModal" x-transition id="showCategory"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $showTitle ?? 'Category Details' }}
                        </h3>
                        <button type="button" @click="$wire.showModal = false"
                            class="bg-red-500 text-white hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        @if ($selectedCategory)
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                    <div class="flex items-center justify-center">
                                        <img src="{{ $selectedCategory->image ? asset('storage/categories/' . $selectedCategory->image) : 'https://i.pravatar.cc/500' }}" alt="{{ $selectedCategory->name }}"
                                            class="w-20 h-20 rounded-lg">
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <div
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedCategory->name }}
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <div
                                        class="bg-gray-50 border h-auto border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedCategory->description ? $selectedCategory->description : '-' }}
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created
                                        At</label>
                                    <div
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedCategory->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main modal detail category -->

</div>
