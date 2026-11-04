<!--- cta-bg preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wezwanie do działania - Tło</div>
			<span class="acf-preview__slug">acf/cta-bg</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($cta_bg['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($cta_bg['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($cta_bg['title']))
		<p class="text-h5">{{ $cta_bg['title'] }}</p>
		@endif
		@if (!empty($cta_bg['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($cta_bg['content']), 24) !!}</p>
		@endif
		@if (!empty($cta_bg['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $cta_bg['button']['title'] }}</span></div>
		@endif
	</div>
</div>
