<!--- gallery preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Galeria</div>
			<span class="acf-preview__slug">acf/gallery</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_gallery['title']))
		<p class="text-h5">{{ $g_gallery['title'] }}</p>
		@endif
		@if (!empty($g_gallery['gallery']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($g_gallery['gallery'] ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['ID'], 'thumbnail') !!}</figure>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
