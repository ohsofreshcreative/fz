<!--- accordion preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Rozwijane panele</div>
			<span class="acf-preview__slug">acf/accordion</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_accordion['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_accordion['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_accordion['title']))
		<p class="text-h5">{{ $g_accordion['title'] }}</p>
		@endif
		@if (!empty($g_accordion['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_accordion['txt']), 24) !!}</p>
		@endif
		@if (!empty($repeater))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $repeater, 0, 3) as $item)
			<div class="acf-preview__card">
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
