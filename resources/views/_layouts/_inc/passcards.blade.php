<section class="container padding-top-3x">
  <div class="row">
    @foreach ($passes as $p)
    <div class="col-md-4 col-sm-6">
      <div class="card mb-30"><a class="card-img-tiles" href="{{ route('passes.show', $p->slug) }}">
          <div class="inner">
            <div class="main-img"><img src="/img/destinations/{{ $p->slug }}-315x278.jpg" alt="{{ $p->name }}"></div>
            <div class="thumblist"><img src="/img/destinations/{{ $p->slug }}-1-155x137.jpg" alt="{{ $p->name }}"><img src="/img/destinations/{{ $p->slug }}-2-155x137.jpg" alt="{{ $p->name }}"></div>
          </div></a>
        <div class="card-body text-center">
          <h4 class="card-title">{{ $p->name }}</h4>
          @if (count($p->discounts))
            <a class="btn btn-primary" href="{{ route('passes.show', $p->slug) }}"><strong>{{ count($p->discounts) }}</strong> Discounts</a>
          @else
            <a class="btn btn-primary" href="{{ route('passes.show', $p->slug) }}">Available May 1st</a>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>