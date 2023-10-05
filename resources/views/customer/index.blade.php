<x-app-layout>
    <div class="grid grid-cols-12 gap-2">
        @foreach($customers as $customer)
            <a href="{{ route('customer.update_index', ['customer_code' => $customer->customer_code]) }}" class="col-span-12 xl:col-span-3">
                <div>
                    <p class="py-2 text-sm text-center text-white bg-theme-main">{{ $customer->customer_name }}</p>
                    <p class="py-2 text-sm text-center bg-theme-sub">{{ $customer->base->base_name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>