<!--- three-columns preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Trzy kolumny</div>
			<span class="acf-preview__slug">acf/three-columns</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($threecols['image1']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($threecols['image1']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($threecols['image2']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($threecols['image2']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($threecols['title']))
		<p class="text-h5">{{ $threecols['title'] }}</p>
		@endif
		@if (!empty($threecols['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($threecols['content']), 24) !!}</p>
		@endif
	</div>
</div>
