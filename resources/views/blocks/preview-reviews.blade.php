<!--- reviews preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Slider - Opinie</div>
			<span class="acf-preview__slug">acf/reviews</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_reviews['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_reviews['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_reviews['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_reviews['subtitle']) }}</p>
		@endif
		@if (!empty($g_reviews['title']))
		<p class="text-h5">{{ $g_reviews['title'] }}</p>
		@endif
		@if (!empty($g_reviews['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_reviews['txt']), 24) !!}</p>
		@endif
		@if (!empty($r_reviews))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $r_reviews, 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['img']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['img']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['name']))
				<p class="text-h5">{{ $item['name'] }}</p>
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
