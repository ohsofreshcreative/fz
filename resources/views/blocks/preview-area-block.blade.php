<!--- area-block preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Obszar działania</div>
			<span class="acf-preview__slug">acf/area-block</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		<p>Obszar działania pobierany automatycznie z ustawień motywu.</p>
	</div>
</div>
