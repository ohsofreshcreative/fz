<!--- team preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Nasz zespół</div>
			<span class="acf-preview__slug">acf/team</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_team['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_team['subtitle']) }}</p>
		@endif
		@if (!empty($g_team['title']))
		<p class="text-h5">{{ $g_team['title'] }}</p>
		@endif
		@if (!empty($g_team['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_team['content']), 24) !!}</p>
		@endif
		@if (!empty($repeater))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $repeater, 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['card_image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['card_image']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['card_title']))
				<p class="text-h5">{{ $item['card_title'] }}</p>
				@endif
				@if (!empty($item['card_function']))
				<p>{{ $item['card_function'] }}</p>
				@endif
				@if (!empty($item['card_mail']))
				<p>{{ $item['card_mail'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
