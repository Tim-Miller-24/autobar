<div class="text-7xl uppercase text-primary my-4">
    {{ $category->name }}
</div>
<div class="flex flex-row mb-10">
    @php
        $class = "text-link-main";
        if(isset(Route::current()->parameters()['id'])
            AND (Route::current()->parameters()['id'] == $category->id)) {
            $class = "text-white";
        }
    @endphp
    @if($category->parent)
        <div class="mr-5">
            <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->parent->id]) }}'"
                    class="focus:outline-none max-w-screen-lg
{{ (Route::current()->parameters()['id'] == $category->parent->id) ? "text-white" : "text-link-main" }}
                            text-left py-2">
                <h2 class="text-2xl leading-9 font-bold">
                    {{ trans('custom.popular') }}
                </h2>
            </button>
        </div>
        @if($category->parent->children->count())
            @foreach($category->parent->children as $children)
                @php
                    $class = "text-link-main";
                    if(Route::current()->parameters()['id'] == $children->id) {
                        $class = "text-white";
                    }
                @endphp
                @if($children->activeItems->count())
                    <div class="mr-5">
                        <button onclick="location.href='{{ route('cash.category.show', ['id' => $children->id]) }}'"
                                class="focus:outline-none max-w-screen-lg {{ $class }} text-left py-2">
                            <h2 class="text-2xl leading-9 font-bold">
                                {{ $children->name }}
                            </h2>
                        </button>
                    </div>
                @endif
            @endforeach
        @endif
    @else
        <div class="mr-5">
            <button onclick="location.href='{{ route('cash.category.show', ['id' => $category->id]) }}'"
                    class="focus:outline-none max-w-screen-lg {{ $class }} text-left py-2">
                <h2 class="text-2xl leading-9 font-bold">
                    {{ trans('custom.popular') }}
                </h2>
            </button>
        </div>
        @if($category->children->count())
            @foreach($category->children as $children)
                @php
                    $class = "text-link-main";
                    if(isset(Route::current()->parameters()['id'])
                        AND (Route::current()->parameters()['id'] == $children->id)) {
                        $class = "text-white";
                    }
                @endphp
                @if($children->activeItems->count())
                    <div class="mr-5">
                        <button onclick="location.href='{{ route('cash.category.show', ['id' => $children->id]) }}'"
                                class="focus:outline-none max-w-screen-lg {{ $class }} text-left py-2">
                            <h2 class="text-2xl leading-9 font-bold">
                                {{ $children->name }}
                            </h2>
                        </button>
                    </div>
                @endif
            @endforeach
        @endif
    @endif
</div>
