@php
$sectionClass = '';
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<!--- b-logos --->

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="b-logos section-s-light -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
    <div class="{{ $block->classes }}">
        <div class="__wrapper c-main block">
            @if(!empty($g_logos['title']))
                <h2 class="secondary w-3/4 mb-10">{{ $g_logos['title'] }}</h2>
            @endif
        </div>

        @if(!empty($logos))
            <div class="swiper logos-swiper c-main !overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($logos as $logo)
                        @if(!empty($logo['url']))
                            <div class="swiper-slide !w-auto">
                                <div class="flex items-center justify-center bg-white h-30 px-6">
                                    <img
                                        src="{{ $logo['url'] }}"
                                        alt="{{ $logo['alt'] ?? 'Logo partnera' }}"
                                        class="max-h-16 w-auto object-contain"
                                        loading="lazy"
                                    >
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>