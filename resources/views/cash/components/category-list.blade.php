<ul class="md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
    @foreach($categories as $category)
        @include('cash.components.category-single', $category)
    @endforeach
</ul>