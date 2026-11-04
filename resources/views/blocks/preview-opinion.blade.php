<!--- opinion preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Opinia</div>
			<span class="acf-preview__slug">acf/opinion</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_opinion['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_opinion['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_opinion['title']))
		<p class="text-h5">{{ $g_opinion['title'] }}</p>
		@endif
		@if (!empty($g_opinion['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_opinion['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_opinion['signature']))
		<p>{{ $g_opinion['signature'] }}</p>
		@endif
	</div>
</div>
