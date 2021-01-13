<li>
    <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
            class="focus:outline-none max-w-screen-lg bg-purple-800 hover:bg-indigo-600 shadow mx-auto text-center py-12 w-full">
        <h2 class="text-3xl leading-9 font-bold tracking-tight text-white sm:text-4xl sm:leading-10">
            {{ $category->name }}
        </h2>
    </button>
</li>
