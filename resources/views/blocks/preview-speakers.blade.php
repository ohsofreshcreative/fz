<!--- speakers preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Członkowie</div>
			<span class="acf-preview__slug">acf/speakers</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_speakers['title']))
		<p class="text-h5">{{ $g_speakers['title'] }}</p>
		@endif
		@if (!empty($g_speakers['header']))
		<p class="text-h6">{{ wp_strip_all_tags($g_speakers['header']) }}</p>
		@endif
		@if (!empty($g_speakers['r_speakers']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $g_speakers['r_speakers'], 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['img']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['img']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['title']))
				<p class="text-h5">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['txt']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
