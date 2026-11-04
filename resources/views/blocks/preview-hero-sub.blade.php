<!--- hero-sub preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Podstrona</div>
			<span class="acf-preview__slug">acf/hero-sub</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_hero_sub['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_hero_sub['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_hero_sub['header']))
		<p class="text-h5">{{ $g_hero_sub['header'] }}</p>
		@endif
		@if (!empty($g_hero_sub['text']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_hero_sub['text']), 24) !!}</p>
		@endif
		@if (!empty($g_hero_sub['button1']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_hero_sub['button1']['title'] }}</span></div>
		@endif
		@if (!empty($g_hero_sub['button2']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_hero_sub['button2']['title'] }}</span></div>
		@endif
	</div>
</div>
