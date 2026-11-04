<!--- offer-cards-block preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kafelki oferty</div>
			<span class="acf-preview__slug">acf/offer-cards-block</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($subtitle))
		<p class="text-h6">{{ wp_strip_all_tags($subtitle) }}</p>
		@endif
		@if (!empty($title))
		<p class="text-h5">{{ $title }}</p>
		@endif
		<p>Oferty w zakładkach według kategorii, pobierane automatycznie.</p>
	</div>
</div>
