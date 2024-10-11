<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
    <div class="block-4 text-center border">
        <figure class="block-4-image">
            <a href="shop-single.html">
                <img src="{{ $product['img'] }}" alt="Image placeholder"
                    class="img-fluid"></a>
        </figure>
        <div class="block-4-text p-4">
            <h3><a href="shop-single.html">{{ $product['name'] }}</a></h3>
            <p class="mb-0">{{ $product['describe'] }}</p>
            <p class="text-primary font-weight-bold">{{ $product['price'] }}</p>
        </div>
    </div>
</div>