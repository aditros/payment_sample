<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (! empty($payments))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->total_product }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->total_payment }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->payment_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="p-6 text-gray-900">
                    {{ __("No payments found!") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
