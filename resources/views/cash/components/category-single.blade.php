<li>
    <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
            class="focus:outline-none my-10 text-left">
        <h2 class="text-7xl leading-9 text-link-main">
            {{ $category->name }}
        </h2>
    </button>
</li>
