<!--- reach preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dołącz do nas</div>
			<span class="acf-preview__slug">acf/reach</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_reach_1['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_reach_1['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_reach_1['title']))
		<p class="text-h5">{{ $g_reach_1['title'] }}</p>
		@endif
		@if (!empty($g_reach_1['header']))
		<p class="text-h6">{{ wp_strip_all_tags($g_reach_1['header']) }}</p>
		@endif
		@if (!empty($g_reach_1['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_reach_1['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_reach_1['person']))
		<p>{{ $g_reach_1['person'] }}</p>
		@endif
		@if (!empty($g_reach_1['phone']))
		<p>{{ $g_reach_1['phone'] }}</p>
		@endif
		@if (!empty($g_reach_1['mail']))
		<p>{{ $g_reach_1['mail'] }}</p>
		@endif
		@if (!empty($g_reach_2['title']))
		<p class="text-h5">{{ $g_reach_2['title'] }}</p>
		@endif
		<p>Formularz kontaktowy osadzany z shortcode.</p>
	</div>
</div>
