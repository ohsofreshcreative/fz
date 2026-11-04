<!--- text-tiles preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Treść + Kafelki (pionowo)</div>
			<span class="acf-preview__slug">acf/text-tiles</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_tiles['title']))
		<p class="text-h6">{{ wp_strip_all_tags($g_tiles['title']) }}</p>
		@endif
		@if (!empty($g_tiles['header']))
		<p class="text-h5">{{ $g_tiles['header'] }}</p>
		@endif
		@if (!empty($g_tiles['text']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_tiles['text']), 24) !!}</p>
		@endif
		@if (!empty($repeater))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $repeater, 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['header']))
				<p class="text-h5">{{ $item['header'] }}</p>
				@endif
				@if (!empty($item['txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['txt']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		@if (!empty($g_tiles['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_tiles['button']['title'] }}</span></div>
		@endif
	</div>
</div>
