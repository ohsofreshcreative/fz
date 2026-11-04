<!--- counter preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Licznik czasu</div>
			<span class="acf-preview__slug">acf/counter</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_counter['date']))
		<p>Odliczanie do: {{ $g_counter['date'] }}</p>
		@endif
	</div>
</div>
