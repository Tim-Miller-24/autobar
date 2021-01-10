<li class="mt-10 md:mt-0">
    <a href="{{ route('cash.category.show', ['id' => $category->id]) }}">
        <div class="max-w-screen-lg bg-indigo-600 hover:bg-purple-800 shadow mx-auto text-center py-12 mt-4">
            <h2 class="text-3xl leading-9 font-bold tracking-tight text-white sm:text-4xl sm:leading-10">
                {{ $category->name }}
            </h2>
        </div>
    </a>
</li>
