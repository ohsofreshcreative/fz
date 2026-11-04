<!--- hero preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero</div>
			<span class="acf-preview__slug">acf/hero</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_hero['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_hero['image']['ID'], 'thumbnail') !!}</figure>
		@elseif (!empty($g_hero['video_poster']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_hero['video_poster']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_hero['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_hero['subtitle']) }}</p>
		@endif
		@if (!empty($g_hero['title']))
		<p class="text-h5">{{ $g_hero['title'] }}</p>
		@endif
		@if (!empty($g_hero['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_hero['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_hero['date']))
		<p>{{ $g_hero['date'] }}</p>
		@endif
		@if (!empty($g_hero['place']))
		<p>{{ $g_hero['place'] }}</p>
		@endif
		@if (!empty($g_hero['certs']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($g_hero['certs'] ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['cert_image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['cert_image']['ID'], 'thumbnail') !!}</figure>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		@if (!empty($g_hero['button1']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_hero['button1']['title'] }}</span></div>
		@endif
		@if (!empty($g_hero['button2']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_hero['button2']['title'] }}</span></div>
		@endif
	</div>
</div>
