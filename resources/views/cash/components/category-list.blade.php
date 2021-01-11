<ul class="md:grid md:grid-cols-2 md:gap-x-6 md:gap-y-6">
    @foreach($categories as $category)
        @include('cash.components.category-single', $category)
    @endforeach
</ul>