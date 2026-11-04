<!--- twocolumns preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dwie kolumny</div>
			<span class="acf-preview__slug">acf/twocolumns</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($col1['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($col1['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($col1['title']))
		<p class="text-h6">{{ wp_strip_all_tags($col1['title']) }}</p>
		@endif
		@if (!empty($col1['header']))
		<p class="text-h5">{{ $col1['header'] }}</p>
		@endif
		@if (!empty($col1['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($col1['content']), 24) !!}</p>
		@endif
		@if (!empty($col2['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($col2['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($col2['where']))
		<p>{!! wp_trim_words(wp_strip_all_tags($col2['where']), 24) !!}</p>
		@endif
		@if (!empty($col2['when']))
		<p>{!! wp_trim_words(wp_strip_all_tags($col2['when']), 24) !!}</p>
		@endif
		@if (!empty($col2['button1']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $col2['button1']['title'] }}</span></div>
		@endif
		@if (!empty($col2['button2']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $col2['button2']['title'] }}</span></div>
		@endif
	</div>
</div>
