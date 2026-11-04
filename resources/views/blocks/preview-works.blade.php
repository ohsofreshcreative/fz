<!--- works preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Realizacje - Galeria</div>
			<span class="acf-preview__slug">acf/works</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($tiles['title']))
		<p class="text-h5">{{ $tiles['title'] }}</p>
		@endif
		@if (!empty($tiles['repeater']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $tiles['repeater'], 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['card_image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['card_image']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['card_title']))
				<p class="text-h5">{{ $item['card_title'] }}</p>
				@endif
				@if (!empty($item['card_txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['card_txt']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
