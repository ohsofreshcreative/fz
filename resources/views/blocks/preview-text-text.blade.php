<!--- text-text preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst - dwie kolumny</div>
			<span class="acf-preview__slug">acf/text-text</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g1_text_text['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g1_text_text['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g1_text_text['title']))
		<p class="text-h6">{{ wp_strip_all_tags($g1_text_text['title']) }}</p>
		@endif
		@if (!empty($g1_text_text['header']))
		<p class="text-h5">{{ $g1_text_text['header'] }}</p>
		@endif
		@if (!empty($g1_text_text['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g1_text_text['content']), 24) !!}</p>
		@endif
		@if (!empty($g2_text_text['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g2_text_text['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g2_text_text['title']))
		<p class="text-h6">{{ wp_strip_all_tags($g2_text_text['title']) }}</p>
		@endif
		@if (!empty($g2_text_text['header']))
		<p class="text-h5">{{ $g2_text_text['header'] }}</p>
		@endif
		@if (!empty($g2_text_text['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g2_text_text['content']), 24) !!}</p>
		@endif
	</div>
</div>
