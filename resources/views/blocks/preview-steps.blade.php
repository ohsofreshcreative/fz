<!--- steps preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Proces - Kafelki po prawej</div>
			<span class="acf-preview__slug">acf/steps</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_steps['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_steps['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_steps['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_steps['subtitle']) }}</p>
		@endif
		@if (!empty($g_steps['title']))
		<p class="text-h5">{{ $g_steps['title'] }}</p>
		@endif
		@if (!empty($g_steps['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_steps['txt']), 24) !!}</p>
		@endif
		@if (!empty($r_steps))
		<div class="acf-preview__grid acf-preview__grid--icons">
			@foreach (array_slice((array) $r_steps, 0, 3) as $item)
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
	</div>
</div>
