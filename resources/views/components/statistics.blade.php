@if($statistics->isNotEmpty())
    <section class="numbers mt-2">
        <div class="row">
            @foreach($statistics as $index => $statistic)
                <div class="col d-flex justify-content-center align-items-center p-5 {{ $index % 2 === 0 ? 'numbers__bg__lighter' : 'numbers__bg__darker' }}">
                    <i class="{{ $statistic->icon }}"></i>
                    <div>
                        <h3>{{ $statistic->value }}</h3>
                        <h5>{!! nl2br(e($statistic->getTranslation('label', $locale))) !!}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
