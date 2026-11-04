<!--- hero-news preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Newsletter</div>
			<span class="acf-preview__slug">acf/hero-news</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_hero_news['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_hero_news['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_hero_news['header']))
		<p class="text-h5">{{ $g_hero_news['header'] }}</p>
		@endif
		@if (!empty($g_hero_news['text']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_hero_news['text']), 24) !!}</p>
		@endif
		@if (!empty($g_hero_news['title']))
		<p class="text-h5">{{ $g_hero_news['title'] }}</p>
		@endif
		@if (!empty($g_hero_news['opis']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_hero_news['opis']), 24) !!}</p>
		@endif
	</div>
</div>
