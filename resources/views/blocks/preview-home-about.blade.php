<!--- home-about preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Strona główna - O nas</div>
			<span class="acf-preview__slug">acf/home-about</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_about['image1']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_about['image1']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_about['image2']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_about['image2']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_about['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_about['subtitle']) }}</p>
		@endif
		@if (!empty($g_about['header']))
		<p class="text-h5">{{ $g_about['header'] }}</p>
		@endif
		@if (!empty($g_about['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_about['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_about['where']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_about['where']), 24) !!}</p>
		@endif
		@if (!empty($g_about['when']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_about['when']), 24) !!}</p>
		@endif
		@if (!empty($g_about['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_about['button']['title'] }}</span></div>
		@endif
	</div>
</div>
