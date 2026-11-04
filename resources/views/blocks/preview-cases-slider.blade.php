<!--- cases-slider preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Realizacje - Slider</div>
			<span class="acf-preview__slug">acf/cases-slider</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($title))
		<p class="text-h5">{{ $title }}</p>
		@endif
		<p>Slider realizacji pobieranych automatycznie.</p>
	</div>
</div>
