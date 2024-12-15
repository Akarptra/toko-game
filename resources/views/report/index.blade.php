<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Search Form -->
                    <div class="flex justify-center items-center mb-4 py-4 w-full">
                        <form method="GET" action="{{ route('report.index') }}" class="flex w-full max-w-4xl">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Search Report..."
                                class="px-4 py-2 border rounded-md mr-4 w-full sm:w-[700px]"
                            >
                            <button type="submit" class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Search</button>
                        </form>
                    </div>




                    <h1 class="text-2xl font-semibold mb-4">Report Purchased</h1>

                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2">#</th>
                                    <th class="border-b px-4 py-2">Product</th>
                                    <th class="border-b px-4 py-2">Buyer</th>
                                    <th class="border-b px-4 py-2">Price</th>
                                    <th class="border-b px-4 py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $index => $report)
                                    <tr>
                                        <td class="border-b px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border-b px-4 py-2">{{ $report->product->nama }}</td>
                                        <td class="border-b px-4 py-2">{{ $report->user->name }}</td>
                                        <td class="border-b px-4 py-2">Rp {{ number_format($report->harga) }}</td>
                                        <td class="border-b px-4 py-2">{{ $report->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $reports->links() }} <!-- Menampilkan link pagination -->
                    </div>


                        <!-- Date Range Filter Form -->
                        <div class="mb-4 py-4">
                            <form method="GET" action="{{ route('report.index') }}" class="flex justify-end w-full">
                                <!-- Start Date Field -->
                                <input 
                                    type="date" 
                                    name="start_date" 
                                    value="{{ request('start_date') }}" 
                                    class="px-4 py-2 border rounded-md mr-4"
                                >

                                <!-- End Date Field -->
                                <input 
                                    type="date" 
                                    name="end_date" 
                                    value="{{ request('end_date') }}" 
                                    class="px-4 py-2 border rounded-md mr-4"
                                >

                                <button type="submit" class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Filter</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
