@extends('layouts.app')


@section('content')

  <!-- Start products hero section -->
  <div class="container-fluid px-0">
    <section class="hero-section">
      <h1 class="mb-4">Produktai</h1>
    </section>
  </div>

  <!-- Start products section -->
  <div class="container">

    <section class="products-section py-5">

        @foreach($products as $product)

            <div class="row product-block mb-5">
                <div class="col-12 col-md-4">
                  <a href="{{ route('show', ['id' => $product->id]) }}">
                    <div class="product-photo">
                        <img src="{{ $product->photo }}" class="img-fluid">
                    </div>
                  </a>
                </div>

                <div class="col-12 col-md-8">
                  <a href="{{ route('show', ['id' => $product->id]) }}">
                    <div class="product-content">
                        <div class="product-sku">
                            <p>SKU: {{ $product->sku  }}</p>
                        </div>

                        <div class="product-description">
                            <p>Aprašymas: {{ $product->description  }}</p>
                        </div>

                        <div class="product-size">
                            <p>Dydis: {{ $product->size  }}</p>
                        </div>



                        @if($product->getStock)
                        <div class="product-stock">

                            <p> Produkto likutis: {{ $product->getStock->stock  }} </p>

                        </div>
                        @endif

                        @if($product->getStock)
                            <div class="product-city">

                                <p> Produkto miestas: {{ $product->getStock->city  }} </p>

                            </div>
                        @endif


                        @if($product->tag)
                            @foreach($product->tag as $tag)
                                <p>Produkto tagas: {{  $tag->name }}</p>
                            @endforeach
                        @endif

                        <div class="product-action">
                            <a href="{{ route('show', ['id' => $product->id]) }}" class="btn btn-primary">Peržiūrėti produktą</a>
                        </div>



                    </div>
                  </a>
                </div>
            </div>
        @endforeach
    </section>

      <div class="d-flex justify-content-center py-5">
          {!! $products->links() !!}
      </div>
  </div>


@endsection
