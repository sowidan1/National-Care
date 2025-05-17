<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Manage Products</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                Add Product
            </a>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            {{ session('error') }}
        </div>
        @endif

        <!-- Products Table with DataTables -->
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <!-- Filter controls -->
            <div class="p-5 bg-gray-50 border-b">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Category</label>
                        <select id="category-filter" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price-min" class="block text-sm font-medium text-gray-700 mb-1">Min Price</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" id="price-min" class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                        </div>
                    </div>
                    <div>
                        <label for="price-max" class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" id="price-max" class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                        </div>
                    </div>


                </div>
                <div class="relative mt-10">
                    <input type="search" id="products-search" class="block w-full md:w-64 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search products...">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="products-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($product->image_url)
                                    <div class="flex-shrink-0 h-10 w-10 mr-3">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                    </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 product-price" data-price="{{ $product->price }}">${{ number_format($product->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->category)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $product->category->name }}
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    No Category
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    <!-- Laravel pagination links -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#products-table').DataTable({
                dom: '',
                paging: true,
                ordering: true,
                pageLength: 10,
                searching: true, // Enable built-in search
                info: true,
                responsive: true,
                language: {
                    info: "Showing _START_ to _END_ of _TOTAL_ products",
                    // infoEmpty: "No products available",
                    infoFiltered: "(filtered from _MAX_ total products)",
                    paginate: {
                        first: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M9.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>',
                        previous: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>',
                        next: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>',
                        last: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 6.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-3.293a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>'
                    }
                },
                drawCallback: function() {
                    // Style the pagination controls with Tailwind classes
                    $('.dataTables_paginate > .pagination').addClass('inline-flex items-center -space-x-px');
                    $('.dataTables_paginate > .pagination > .paginate_button').addClass('px-3 py-1 bg-white border text-sm leading-tight text-gray-500 hover:bg-gray-100');
                    $('.dataTables_paginate > .pagination > .paginate_button.current').addClass('z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative');
                    $('.dataTables_paginate > .pagination > .paginate_button:not(.current)').addClass('bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative');
                    $('.dataTables_paginate > .pagination > .paginate_button.disabled').addClass('text-gray-300 cursor-not-allowed');
                }
            });

            // Connect custom search input
            $('#products-search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Connect custom length menu
            $('#products-length').on('change', function() {
                table.page.len($(this).val()).draw();
            });

            // Category filter
            $('#category-filter').on('change', function() {
                table.column(2).search($(this).val()).draw();
            });

            // Custom price range filter
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var minPrice = parseFloat($('#price-min').val()) || 0;
                    var maxPrice = parseFloat($('#price-max').val()) || Infinity;
                    var priceCell = $(table.cell(dataIndex, 1).node());
                    var price = parseFloat(priceCell.find('.product-price').attr('data-price')) || 0;

                    return (price >= minPrice && price <= maxPrice);
                }
            );

            // Apply price filters when inputs change
            $('#price-min, #price-max').on('input', function() {
                table.draw();
            });

            // Hide the Laravel pagination since DataTables provides its own
            // Hide the entire Laravel pagination container
            $('#table-footer').remove();
        });
    </script>
</x-app-layout>
