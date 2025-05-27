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
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                        Done
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>
