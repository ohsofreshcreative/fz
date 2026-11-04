<!--- partners-block preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Partnerzy</div>
			<span class="acf-preview__slug">acf/partners-block</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		<p>Lista partnerów pobierana automatycznie z panelu „Partnerzy”.</p>
	</div>
</div>
