@php
    $childrens = $category->children;
    $class = "";
    if(isset(Route::current()->parameters()['id'])
        AND (Route::current()->parameters()['id'] == $category->id)
        OR (isset(Route::current()->parameters()['id']) AND (is_object($childrens))
        AND in_array(Route::current()->parameters()['id'], $childrens->pluck('id')->toArray()))
    ) {
        $class = "bg-active";
    }
@endphp
<li class="border-b border-primary py-0.5 px-3 {{ $class }} {{ $category->css_class }}">
    <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
            class="focus:outline-none my-2 w-full text-left">
        @if($category->image)
            <img src="{{ $category->image_url }}" class="w-9 h-9 float-left mr-5" />
            <h2 class="text-xl text-white pt-1.5">
                {{ $category->name }}
            </h2>
        @else
            <h2 class="text-xl text-white">
                {{ $category->name }}
            </h2>
        @endif
    </button>
</li>
@if($childrens
    AND isset(Route::current()->parameters()['id'])
    AND (Route::current()->parameters()['id'] == $category->id)
    OR $childrens
        AND isset(Route::current()->parameters()['id'])
        AND in_array(Route::current()->parameters()['id'], $childrens->pluck('id')->toArray()))
    <ul class="mt-2 px-2">
        @foreach($childrens as $children)
            @php
                $children_class = "";
                if(Route::current()->parameters()['id'] == $children->id) {
                    $children_class = "bg-active";
                }
            @endphp
            <li class="w-full bg-primary mb-1.5 shadow {{ $children_class }}">
                <a href="{{ route('cash.category.show', ['id' => $children->id]) }}" class="inline-block text-white w-full p-2">
                    {{ $children->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
