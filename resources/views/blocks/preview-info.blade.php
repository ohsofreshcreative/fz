<!--- info preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Informacje</div>
			<span class="acf-preview__slug">acf/info</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_info['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_info['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_info['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_info['subtitle']) }}</p>
		@endif
		@if (!empty($g_info['title']))
		<p class="text-h5">{{ $g_info['title'] }}</p>
		@endif
		@if (!empty($g_info['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_info['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_info['r_info']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($g_info['r_info'] ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['image']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['header']))
				<p class="text-h5">{{ $item['header'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['text']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		@if (!empty($g_info['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_info['button']['title'] }}</span></div>
		@endif
	</div>
</div>
