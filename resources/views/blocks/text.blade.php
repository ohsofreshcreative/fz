@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

@endphp

<!--- text -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="text relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			

			<div class="__content order2">
				<p data-gsap-element="subtitle" class="__subtitle subtitle-s">{{ $g_text['subtitle'] }}</p>
				<h2 data-gsap-element="header" class="text-white">{{ $g_text['header'] }}</h2>

				<div data-gsap-element="txt" class="text-white mt-2">
					{!! $g_text['txt'] !!}
				</div>

				@if (!empty($g_text['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_text['button']['url'] }}">{{ $g_text['button']['title'] }}</a>
				@endif

			</div>

		</div>

</section>