<div class="wrap-search center-section">
    <div class="wrap-search-form">
        <form action="{{ route('product.search') }}" id="form-search-top" name="form-search-top">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search here...">
            <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            <div class="wrap-list-cate">
                <input type="hidden" name="product_cat" value="{{$product_cat}}" id="product-cate">
                <input type="hidden" name="product_cat_id" value="{{$product_cat_id}}" id="product-cate-id">
                <a href="#" class="link-control">All Category</a>
                <ul class="list-cate">
                    <li class="level-0">{{ str_split($product_cat, 12)[0] }}</li>
                    @foreach($categories as  $categiry)
                        <li class="level-1" data-id="{{ $categiry->id }}">{{ $categiry->name }}</li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>
</div>
