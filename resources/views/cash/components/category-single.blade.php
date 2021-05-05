@php
    $childrens = $category->childrenActive;
    $class = "";
    if(isset(Route::current()->parameters()['id'])
        AND (Route::current()->parameters()['id'] == $category->id)
        OR (isset(Route::current()->parameters()['id']) AND (is_object($childrens))
        AND in_array(Route::current()->parameters()['id'], $childrens->pluck('id')->toArray()))
    ) {
        $class = "bg-active";
    }
@endphp
<li class="border-b border-primary w-full {{ $class }} {{ $category->css_class }}">
    <a href="{{ route('cash.category.show', ['id' => $category->id]) }}"
            class="py-2 px-3 w-full text-left text-xl text-white inline-block uppercase font-bold">
        @if($category->image)
            <img src="{{ $category->image_url }}" class="w-8 h-8 float-left mr-5" />
            <div class="pt-1 inline-block">{{ $category->name }}</div>
        @else
            {{ $category->name }}
        @endif
    </a>
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
