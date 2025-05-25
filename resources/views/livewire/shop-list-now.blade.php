<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg text-center font-semibold">{{ $title . ' - ' . date('F Y') ?? 'Page title' }}</h2>
        <form wire:submit.prevent="saveItems" class="mt-4">
            @php
                $isTwoColumns = count($allItems) > 15;
            @endphp
            <div class="mb-3 grid gap-2 {{ $isTwoColumns ? 'grid-cols-1 md:grid-cols-2' : 'grid-cols-1' }}">
                @foreach ($allItems as $item)
                    <div class="flex items-start space-x-2 mb-2">
                        <input type="checkbox" id="item-{{ $item->id }}" value="{{ $item->id }}"
                            wire:model="selectedItems"
                            class="mt-0.5 flex-shrink-0 rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">

                        <label for="item-{{ $item->id }}" class="leading-tight">
                            {{ $item->item_name }} - {{ $item->category->name }}
                        </label>
                    </div>
                @endforeach
                @error('selectedItems')
                    <p class="text-center text-red-600 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <p class="py-2">Total items: {{ $allItems->count() }}</p>
            @if ($allItems->count() > 0)
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
