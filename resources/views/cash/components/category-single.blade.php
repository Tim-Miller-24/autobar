@php
    $class = "";
    if((isset(Route::current()->parameters()['id'])
        AND (Route::current()->parameters()['id'] == $category->id))) {
        $class = "bg-active";
    }
@endphp
<li class="border-b border-primary py-0.5 px-3 {{ $class }}">
    <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
            class="focus:outline-none my-2 w-full text-left">
        <h2 class="text-xl text-white">
            {{ $category->name }}
        </h2>
    </button>
</li>
@if($category->children
    AND isset(Route::current()->parameters()['id'])
    AND (Route::current()->parameters()['id'] == $category->id))
    <ul class="mt-2 px-2">
        @foreach($category->children as $children)
            <li class="w-full p-2 bg-primary mb-1.5 shadow">
                <a href="#category_{{ $children->id }}" class="inline-block text-white w-full">
                    {{ $children->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
