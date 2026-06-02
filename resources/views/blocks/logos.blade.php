@php
$sectionClass = '';
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
$marqueeLogos = !empty($logos) ? $logos : [];
@endphp

<section id="logotypy" data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="b-logos section-white -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
  <div class="{{ $block->classes }}">
    <div class="__wrapper c-main block">
      @if(!empty($g_logos['title']))
        <h2 class="secondary w-3/4 mb-10">{{ $g_logos['title'] }}</h2>
      @endif
    </div>

    @if(!empty($marqueeLogos))
      <div class="logos-marquee c-main" aria-label="Logotypy partnerow">
        <div class="logos-marquee__track">
          @foreach([0, 1] as $duplicate)
            <div class="logos-marquee__group" @if($duplicate === 1) aria-hidden="true" @endif>
              @foreach($marqueeLogos as $logo)
                @if(!empty($logo['url']))
                  <div class="logos-marquee__item">
                    <img
                      src="{{ $logo['url'] }}"
                      alt="{{ $logo['alt'] ?? 'Logo partnera' }}"
                      @if(!empty($logo['width'])) width="{{ $logo['width'] }}" @endif
                      @if(!empty($logo['height'])) height="{{ $logo['height'] }}" @endif
                      class="max-h-16 w-auto object-contain"
                      loading="eager"
                      decoding="async"
                    >
                  </div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>