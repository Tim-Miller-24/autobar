@php
    $class = "bg-purple-800 hover:bg-indigo-600";
    if(Route::current()->parameters()['id'] == $category->id) {
        $class = "bg-indigo-600 hover:bg-purple-800";
    }
@endphp
<ul class="grid grid-cols-6 gap-2 mb-10">
    @if($category->parent)
        <li>
            <a href="{{ route('cash.category.show', ['id' => $category->parent->id]) }}">
                <div class="max-w-screen-lg {{ (Route::current()->parameters()['id'] == $category->parent->id) ? "bg-indigo-600 hover:bg-purple-800" : "bg-purple-800 hover:bg-indigo-600" }} shadow mx-auto text-center py-2">
                    <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                        {{ $category->parent->name }}
                    </h2>
                </div>
            </a>
        </li>
        @if($category->parent->children->count())
            @foreach($category->parent->children as $children)
                @php
                    $class = "bg-purple-800 hover:bg-indigo-600";
                    if(Route::current()->parameters()['id'] == $children->id) {
                        $class = "bg-indigo-600 hover:bg-purple-800";
                    }
                @endphp
                @if($children->items->count())
                    <li>
                        <a href="{{ route('cash.category.show', ['id' => $children->id]) }}">
                            <div class="max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2">
                                <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                                    {{ $children->name }}
                                </h2>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    @else
        <li>
            <a href="{{ route('cash.category.show', ['id' => $category->id]) }}">
                <div class="max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2">
                    <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                        {{ $category->name }}
                    </h2>
                </div>
            </a>
        </li>
        @if($category->children->count())
            @foreach($category->children as $children)
                @php
                    $class = "bg-purple-800 hover:bg-indigo-600";
                    if(Route::current()->parameters()['id'] == $children->id) {
                        $class = "bg-indigo-600 hover:bg-purple-800";
                    }
                @endphp
                @if($children->items->count())
                    <li>
                        <a href="{{ route('cash.category.show', ['id' => $children->id]) }}">
                            <div class="max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2">
                                <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                                    {{ $children->name }}
                                </h2>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    @endif

</ul>
