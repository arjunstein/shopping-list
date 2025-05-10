<div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">{{ $title ?? 'Page title' }}</h2>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 gap-4">
            <form class="w-full sm:w-auto" method="GET" action="#">
                <input type="text" name="search" placeholder="Search category..."
                    class="w-full sm:w-96 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </form>

            <a href="{{ route('category-create') }}" wire:navigate
                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">Tambah
                Data
            </a>
        </div>

        <div class="overflow-x-auto">
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
                                <img src="https://i.pravatar.cc/50" class="w-8 h-8 rounded-full" alt="User avatar">
                            </td>
                            <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $category->description ? $category->description : "-" }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $category->created_at }}</td>
                            <td class="px-4 py-3 space-x-2 flex">
                                <a href="{{ route('category-edit', $category->id) }}" wire:navigate
                                    class="w-20 inline-flex justify-center items-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700">
                                    Edit
                                </a>
                                <button wire:click="deleteCategory('{{ $category->id }}')"
                                    class="w-20 inline-flex justify-center items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">
                                    Hapus
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
    </div>
</div>
