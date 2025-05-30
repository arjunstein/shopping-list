<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg text-center font-semibold">{{ $title . ' - ' . date('F Y') ?? 'Page title' }}</h2>
        <form wire:submit.prevent="saveItems" class="mt-4">
            @php
                $isTwoColumns = count($allItems) > 15;
            @endphp
            <div class="mb-3 grid gap-2 {{ $isTwoColumns ? 'grid-cols-1 md:grid-cols-2' : 'grid-cols-1' }}">
                @forelse ($allItems as $item)
                    <div x-data="{ selectedItems: @entangle('selectedItems') }" class="flex items-start space-x-2 mb-2">
                        <input type="checkbox" id="item-{{ $item->id }}" :value="'{{ $item->id }}'"
                            x-model="selectedItems"
                            class="mt-0.5 flex-shrink-0 rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">

                        <label for="item-{{ $item->id }}"
                            :class="selectedItems.includes('{{ $item->id }}') ? 'line-through text-gray-400' : ''"
                            class="leading-tight transition duration-150">
                            {{ $item->item_name }} - {{ $item->category->name }}
                        </label>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No items available.</p>
                @endforelse
                @error('selectedItems')
                    <p class="text-center text-red-600 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            @if ($allItems->count() > 0)
                <p class="py-2">{{ 'Total items: ' . $allItems->count() }}</p>
            @endif
        </form>
        <div x-data="{ showConfirmModal: false }">
            <!-- Button Done -->
            <div class="flex justify-center">
                <button type="button" wire:click="$set('showModalConfirmDone', true)"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                    Done
                </button>
            </div>

            <!-- Modal Konfirmasi -->
            <div x-cloak x-show="$wire.showModalConfirmDone" x-transition
                class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md">
                    <!-- Modal Header -->
                    <div class="px-4 py-3 border-b dark:border-gray-600">
                        <h3
                            class="flex items-center justify-center text-lg font-semibold text-blue-600 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-8 h-8 mt-4">
                                <path
                                    d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </h3>
                    </div>
                    <!-- Modal Body -->
                    <div class="p-4 text-md text-center text-gray-700 dark:text-gray-300">
                        Are you sure you want to submit your selected items?
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center justify-center gap-3 px-4 py-4">
                        <button wire:click="$set('showModalConfirmDone', false)"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button wire:click="saveItems" @click="$wire.set('showModalConfirmDone', false)"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Yes, Submit
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
