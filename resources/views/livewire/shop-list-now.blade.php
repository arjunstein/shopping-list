<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">{{ $title ?? 'Page title' }}</h2>
        <form wire:submit.prevent="saveItems" class="mt-4">
            @php
                $isTwoColumns = count($allItems) > 15;
            @endphp
            <div class="mb-4 grid gap-2 {{ $isTwoColumns ? 'grid-cols-1 md:grid-cols-2' : 'grid-cols-1' }}">
                @foreach ($allItems as $item)
                    <div class="flex items-center">
                        <input type="checkbox" id="item-{{ $item->id }}" value="{{ $item->id }}"
                            wire:model="selectedItems"
                            class="mr-2 rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                        <label for="item-{{ $item->id }}">{{ $item->item_name }} - {{ $item->category->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                Submit
            </button>
        </form>
    </div>
</div>
