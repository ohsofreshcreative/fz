<!--- tailored preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Liczby z tłem</div>
			<span class="acf-preview__slug">acf/tailored</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_tailored['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_tailored['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_tailored['header']))
		<p class="text-h5">{{ $g_tailored['header'] }}</p>
		@endif
		@if (!empty($g_tailored['r_tailored']))
		<div class="acf-preview__grid acf-preview__grid--icons">
			@foreach (array_slice((array) $g_tailored['r_tailored'], 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['img']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['img']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['number']))
				<p class="text-h5">{{ $item['number'] }}</p>
				@endif
				@if (!empty($item['header']))
				<p class="text-h6">{{ $item['header'] }}</p>
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
