<!--- overlap preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Treść oraz duże kafelki</div>
			<span class="acf-preview__slug">acf/overlap</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_overlap['title']))
		<p class="text-h5">{{ $g_overlap['title'] }}</p>
		@endif
		@if (!empty($g_overlap['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_overlap['content']), 24) !!}</p>
		@endif
		@if (!empty($r_overlap))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $r_overlap, 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['r_image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['r_image']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['r_header']))
				<p class="text-h5">{{ $item['r_header'] }}</p>
				@endif
				@if (!empty($item['r_txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['r_txt']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
