<!--- jobs preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Oferty pracy</div>
			<span class="acf-preview__slug">acf/jobs</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_jobs['title']))
		<p class="text-h5">{{ $g_jobs['title'] }}</p>
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
		@if (!empty($g_jobs['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_jobs['subtitle']) }}</p>
		@endif
		@if (!empty($g_jobs['header']))
		<p class="text-h5">{{ $g_jobs['header'] }}</p>
		@endif
		@if (!empty($g_jobs['content']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_jobs['content']), 24) !!}</p>
		@endif
	</div>
</div>
