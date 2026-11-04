<!--- template preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Template</div>
			<span class="acf-preview__slug">acf/template</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($tab1['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($tab1['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($tab1['title']))
		<p class="text-h5">{{ $tab1['title'] }}</p>
		@endif
		@if (!empty($tab1['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($tab1['content']), 24) !!}</p>
		@endif
		@if (!empty($tab1['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $tab1['button']['title'] }}</span></div>
		@endif
	</div>
</div>
