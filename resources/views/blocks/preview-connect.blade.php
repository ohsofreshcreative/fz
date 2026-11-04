<!--- connect preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dane kontaktowe</div>
			<span class="acf-preview__slug">acf/connect</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_connect['header']))
		<p class="text-h5">{{ $g_connect['header'] }}</p>
		@endif
		@if (!empty($g_connect['r_connect']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $g_connect['r_connect'], 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['image']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['header']))
				<p class="text-h5">{{ $item['header'] }}</p>
				@endif
				@if (!empty($item['name']))
				<p>{{ $item['name'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['text']), 24) !!}</p>
				@endif
				@if (!empty($item['phone']))
				<p>{{ $item['phone'] }}</p>
				@endif
				@if (!empty($item['email']))
				<p>{{ $item['email'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
