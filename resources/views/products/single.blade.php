@extends('layouts.app')


@section('content')

    <!-- Start products hero section -->
    <div class="container-fluid px-0">
      <section class="hero-section">
        <h1>Produktas: {{ $product->sku  }}</h1>
      </section>
    </div>

    <!-- Start product section -->
    <div class="container">

        <section class="product-section py-5">

                <div class="row product-block mb-5">
                    <div class="col-12 col-md-4">
                        <div class="product-photo">
                            <img src="{{ $product->photo }}" class="img-fluid">
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
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



                        </div>
                    </div>
                </div>
        </section>

        <section class="related-product py-5">
            <h2 class="mb-5">Panašūs produktai</h2>
            <div class="row">

                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-12 col-md-4">
                      <a href="{{ route('show', ['id' => $relatedProduct->id]) }}">
                        <div class="product-photo mb-3">
                            <img src="{{ $relatedProduct->photo }}" class="img-fluid">
                        </div>

                        <div class="product-description mb-3">
                            <p> {{ $relatedProduct->description  }}</p>
                        </div>

                        <div class="product-size mb-3">
                            <p>{{ $relatedProduct->size  }}</p>
                        </div>

                        <div class="product-action">
                            <a href="{{ route('show', ['id' => $relatedProduct->id]) }}" class="btn btn-primary">Peržiūrėti produktą</a>
                        </div>
                      </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('index')  }}" class="btn btn-secondary">Grįžti</a>
                </div>
            </div>
        </section>

    </div>


@endsection
