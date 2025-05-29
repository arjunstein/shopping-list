<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">{{ $title ?? 'Page title' }}</h2>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 gap-4">
            <form class="w-full sm:w-auto">
                <input type="search" wire:model.live="search" placeholder="Search item..." autocomplete="off"
                    class="w-full sm:w-72 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </form>

            <a href="{{ route('item-create') }}" wire:navigate
                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">Add
                Item
            </a>
        </div>

        <div class="overflow-x-auto py-2">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            No</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            Image</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            Item name</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            Category</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            Created at</th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase whitespace-nowrap">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($items as $i => $item)
                        <tr>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300 whitespace-nowrap">{{ $i + 1 }}
                            </td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                <img src="{{ $item->image ? asset('storage/items/' . $item->image) : 'https://i.pravatar.cc/50' }}"
                                    class="w-10 h-10 rounded-full" alt="{{ $item->category->name }}">
                            </td>
                            <td class="px-4 py-3 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                {{ $item->item_name }}
                            </td>
                            <td class="px-4 py-3 text-gray-900 dark:text-gray-300 whitespace-nowrap">
                                {{ $item->category->name }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                {{ $item->created_at->format('d-M-Y H:i') }}</td>
                            <td class="px-4 py-3 space-x-2 flex">
                                <button type="button" data-modal-target="showItem" data-modal-toggle="showItem"
                                    wire:click="showDetailItem('{{ $item->id }}')"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-purple-600 text-white rounded hover:bg-purple-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <a href="{{ route('item-edit', $item->id) }}" wire:navigate title="Edit"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-green-600 text-white rounded hover:bg-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11.5a.5.5 0 00.5.5H16a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>

                                <button wire:click="confirmDeleteItem('{{ $item->id }}')" title="Delete"
                                    class="w-10 h-10 inline-flex justify-center items-center bg-red-600 text-white rounded hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>

                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Item
                                not found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $items->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Main modal detail item -->
    <div>
        <div x-cloak x-show="$wire.showModalDetailItem" x-transition id="showItem" @click.self="$wire.showModalDetailItem = false"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $showTitle ?? 'Item Details' }}
                        </h3>
                        <button type="button" @click="$wire.showModalDetailItem = false"
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
                        @if ($selectedItem)
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                    <div class="flex items-center justify-center">
                                        <img src="{{ $selectedItem->image ? asset('storage/items/' . $selectedItem->image) : 'https://i.pravatar.cc/500' }}"
                                            alt="{{ $selectedItem->name }}" class="w-20 h-20 rounded-lg">
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <div
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedItem->category->name }}
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item</label>
                                    <div
                                        class="bg-gray-50 border h-auto border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedItem->item_name }}
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created
                                        At</label>
                                    <div
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedItem->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Updated
                                        At</label>
                                    <div
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        {{ $selectedItem->updated_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main modal detail item -->

    <!-- Modal delete confirmation -->
    <div x-cloak x-show="$wire.showModalConfirmDeleteItem" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md">
            <!-- Modal Header -->
            <div class="px-4 py-3 border-b dark:border-gray-600">
                <h3 class="flex items-center justify-center text-lg font-semibold text-red-600 dark:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-8 h-8 mt-4">
                        <path fill-rule="evenodd"
                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                            clip-rule="evenodd" />
                    </svg>
                </h3>
            </div>
            <!-- Modal Body -->
            <div class="p-4 text-md text-center text-gray-700 dark:text-gray-300">
                Are you sure you would like to do this?
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center justify-center gap-3 px-4 py-4">
                <button @click="$wire.showModalConfirmDeleteItem = false"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                    Cancel
                </button>
                <button wire:click="deleteItem('{{ $deleteItemId }}')"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
    <!-- End Modal delete confirmation -->
</div>
