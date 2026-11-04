<!--- agenda preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Agenda2</div>
			<span class="acf-preview__slug">acf/agenda</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		<p>Agenda pobierana automatycznie z Ustawienia → Agenda.</p>
	</div>
</div>
