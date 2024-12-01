<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-fit">
                {{ __('Customer') }}
            </h2>
            <a href="{{ route('customer.create.index') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (! empty($customers))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CC Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acc Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->cc_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->acc_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
                                        <a href="{{ route('customer.edit.index', $customer->id) }}">Edit</a>
                                    </button>
                                    <button>
                                      <form action="{{ route('customer.delete', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="p-6 text-gray-900">
                    {{ __("No customers found!") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
