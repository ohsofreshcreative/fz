<!--- workshops preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Warsztaty w kameralnym gronie</div>
			<span class="acf-preview__slug">acf/workshops</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_workshops['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_workshops['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_workshops['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_workshops['subtitle']) }}</p>
		@endif
		@if (!empty($g_workshops['title']))
		<p class="text-h5">{{ $g_workshops['title'] }}</p>
		@endif
		@if (!empty($g_workshops['text1']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_workshops['text1']), 24) !!}</p>
		@endif
		@if (!empty($g_workshops['text2']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_workshops['text2']), 24) !!}</p>
		@endif
		@if (!empty($g_workshops['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_workshops['button']['title'] }}</span></div>
		@endif
	</div>
</div>
