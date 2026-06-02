@php
$sectionClass = '';
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<!--- b-slides --->

<section id="slides" data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="b-slides -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="{{ $block->classes }}">

		<div class="__wrapper c-main block">
			<h2 class="secondary w-3/4 mb-10">{{ $g_slides['title']}}</h2>
		</div>

		<div class="swiper offer-swiper c-main !overflow-visible">

			<div class="swiper-wrapper">

				@foreach($slides as $card)
				<div class="swiper-slide">
					<div class="__card">
						<div class="__rectangle absolute"></div>
						@if(!empty($card['video']))
						<div class="__video">
							{!! $card['video'] !!}
						</div>
						@endif

						@if(!empty($card['card_title']))
						<h5 class="block m-title">{{ $card['card_title'] }}</h5>
						@endif

						@if(!empty($card['card_txt']))
						<div class="__txt">{{ $card['card_txt'] }}</div>
						@endif

						@if(!empty($card['button']))
						<a href="{{ $card['button']['url'] }}" class="main-btn m-btn" target="{{ $card['button']['target'] }}">
							{{ $card['button']['title'] }}
						</a>
						@endif
					</div>
				</div>
				@endforeach

			</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
		</div>
	</div>

</section>