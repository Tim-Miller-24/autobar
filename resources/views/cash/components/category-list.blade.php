<div class="text-primary font-bold font-4xl p-3 uppercase border-b border-primary">
    {{ trans('custom.choose_category') }}
</div>
<ul>
    @foreach($categories as $category)
        @include('cash.components.category-single', $category)
    @endforeach
</ul>