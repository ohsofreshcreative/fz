<!--- department preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kontat - Działy</div>
			<span class="acf-preview__slug">acf/department</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_department['title']))
		<p class="text-h5">{{ $g_department['title'] }}</p>
		@endif
		@if (!empty($g_department['r_department']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($g_department['r_department'] ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['card_title']))
				<p class="text-h5">{{ $item['card_title'] }}</p>
				@endif
				@if (!empty($item['card_txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['card_txt']), 24) !!}</p>
				@endif
				@if (!empty($item['phone']))
				<p>{{ $item['phone'] }}</p>
				@endif
				@if (!empty($item['mail']))
				<p>{{ $item['mail'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
