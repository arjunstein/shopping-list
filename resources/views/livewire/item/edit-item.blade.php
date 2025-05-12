<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">{{ $title ?? 'Page title' }}</h2>
        <form wire:submit.prevent="editItem" class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Item
                        name</label>
                    <input type="text" wire:model="item_name" id="item_name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('item_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category
                        item</label>
                    <select wire:model="category_id" id="category_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">image</label>
                    <input type="file" wire:model="image" id="image"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="mt-5">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>
