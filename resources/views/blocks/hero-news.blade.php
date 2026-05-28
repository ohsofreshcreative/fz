@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($g_hero_news['image']['url']) ? "linear-gradient(90deg, rgba(0, 34, 85, 0.9) 30%, rgba(0, 34, 85, 0.3) 100%), url({$g_hero_news['image']['url']})" : '';
@endphp

<!-- hero-news -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-hero-news relative {{ $sectionClass }} {{ $section_class }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 items-center gap-8 py-50">

		<div class="__content">

			<h1 data-gsap-element="header" class="text-white m-header">{{ $g_hero_news['header'] }}</h1>

			<div data-gsap-element="text" class="text-white text-xl">{{ strip_tags($g_hero_news['text']) }}</div>

			@if (!empty($g_hero_news['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="second-btn left-btn" href="{{ $g_hero_news['button1']['url'] }}" target="{{ $g_hero_news['button1']['target'] }}">{{ $g_hero_news['button1']['title'] }}</a>

				@if (!empty($g_hero_news['button2']))
				<a data-gsap-element="button" class="white-btn" href="{{ $g_hero_news['button2']['url'] }}" target="{{ $g_hero_news['button2']['target'] }}">{{ $g_hero_news['button2']['title'] }}</a>
				@endif
			</div>
			@endif
		</div>
		<div class="__newsletter bg-dark p-10">

			<h5 class="secondary">Zapisz sie do newslettera</h5>
			<h3 class="text-white mt-2">{{ $g_hero_news['title'] }}</h3>
			<div class="text-white mt-4">{!! $g_hero_news['opis'] !!}</div>
			<div class="contact-form-container mt-4">
				{!! do_shortcode($g_hero_news['shortcode']) !!}
			</div>

		</div>
	</div>

</section>