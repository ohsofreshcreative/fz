<!--- hero-offer preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Oferta</div>
			<span class="acf-preview__slug">acf/hero-offer</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_herooffer['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_herooffer['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_herooffer['title']))
		<p class="text-h5">{{ $g_herooffer['title'] }}</p>
		@endif
		@if (!empty($g_herooffer['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_herooffer['content']), 24) !!}</p>
		@endif
		@if (!empty($nav))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($nav ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['label']))
				<p class="text-h5">{{ $item['label'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
