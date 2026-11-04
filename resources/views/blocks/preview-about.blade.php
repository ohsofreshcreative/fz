<!--- about preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Treść oraz zdjęcie + ikony</div>
			<span class="acf-preview__slug">acf/about</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_about['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_about['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_about['top']))
		<p class="text-h5">{{ $g_about['top'] }}</p>
		@endif
		@if (!empty($g_about['title']))
		<p class="text-h5">{{ $g_about['title'] }}</p>
		@endif
		@if (!empty($g_about['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_about['txt']), 24) !!}</p>
		@endif
		@if (!empty($r_about))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $r_about, 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['image']['ID'], 'thumbnail') !!}</figure>
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
		@if (!empty($g_about['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_about['button']['title'] }}</span></div>
		@endif
	</div>
</div>
