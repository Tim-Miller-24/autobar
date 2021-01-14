<div class="grid grid-cols-6 gap-2 mb-10">
    @php
        $class = "bg-purple-800 hover:bg-indigo-600";
        if(isset(Route::current()->parameters()['id'])
            AND (Route::current()->parameters()['id'] == $category->id)) {
            $class = "bg-indigo-600";
        }
    @endphp
    @if($category->parent)
        <div>
            <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->parent->id]) }}'"
                    class="focus:outline-none max-w-screen-lg
{{ (Route::current()->parameters()['id'] == $category->parent->id) ? "bg-indigo-600" : "bg-purple-800 hover:bg-indigo-600" }}
                            shadow mx-auto text-center py-2 w-full">
                <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                    {{ $category->parent->name }}
                </h2>
            </button>
        </div>
        @if($category->parent->children->count())
            @foreach($category->parent->children as $children)
                @php
                    $class = "bg-purple-800 hover:bg-indigo-600";
                    if(Route::current()->parameters()['id'] == $children->id) {
                        $class = "bg-indigo-600";
                    }
                @endphp
                @if($children->items->count())
                    <div>
                        <button onclick="location.href='{{ route('cash.category.show', ['id' => $children->id]) }}'"
                                class="focus:outline-none max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2 w-full">
                            <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                                {{ $children->name }}
                            </h2>
                        </button>
                    </div>
                @endif
            @endforeach
        @endif
    @else
        <div>
            <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
                    class="focus:outline-none max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2 w-full">
                <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                    {{ $category->name }}
                </h2>
            </button>
        </div>
        @if($category->children->count())
            @foreach($category->children as $children)
                @php
                    $class = "bg-purple-800 hover:bg-indigo-600";
                    if(isset(Route::current()->parameters()['id'])
                        AND (Route::current()->parameters()['id'] == $children->id)) {
                        $class = "bg-indigo-600";
                    }
                @endphp
                @if($children->items->count())
                    <div>
                        <button onclick="location.href='{{ route('cash.category.show', ['id' => $children->id]) }}'"
                                class="focus:outline-none max-w-screen-lg {{ $class }} shadow mx-auto text-center py-2 w-full">
                            <h2 class="text-sm leading-9 font-bold tracking-tight text-white">
                                {{ $children->name }}
                            </h2>
                        </button>
                    </div>
                @endif
            @endforeach
        @endif
    @endif
</div>
