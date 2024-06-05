@vite('resources/css/app.css')
<div class="">
    <img class="object-cover w-32 h-20" src='http://127.0.0.1:8000/storage/{{$getState()}}' alt="Product">

    {{ $getState() }}
</div>
{{-- <div class="w-10 h-10 bg-white rounded-lg shadow-lg">
    <div class="relative overflow-hidden">
        <img class="object-cover w-10 h-10" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="Product">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <button class="px-6 py-2 font-bold text-gray-900 bg-white rounded-full hover:bg-gray-300">View Product</button>
        </div>
    </div>
    <h3 class="mt-4 text-xl font-bold text-gray-900">Product Name</h3>
    <p class="mt-2 text-sm text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed
        ante justo. Integer euismod libero id mauris malesuada tincidunt.</p>
    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold text-gray-900">$29.99</span>
        <button class="px-4 py-2 font-bold text-white bg-gray-900 rounded-full hover:bg-gray-800">Add to Cart</button>
    </div>
</div> --}}
