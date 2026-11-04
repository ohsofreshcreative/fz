<!--- experts preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Eksperci</div>
			<span class="acf-preview__slug">acf/experts</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_experts['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_experts['subtitle']) }}</p>
		@endif
		@if (!empty($g_experts['header']))
		<p class="text-h5">{{ $g_experts['header'] }}</p>
		@endif
		@if (!empty($g_experts['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_experts['txt']), 24) !!}</p>
		@endif
		@if (!empty($gallery))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($gallery ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['ID'], 'thumbnail') !!}</figure>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		@if (!empty($g_experts['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_experts['button']['title'] }}</span></div>
		@endif
	</div>
</div>
