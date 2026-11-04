<!--- cta preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wezwanie do działania</div>
			<span class="acf-preview__slug">acf/cta</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($cta['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($cta['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($cta['title']))
		<p class="text-h5">{{ $cta['title'] }}</p>
		@endif
		@if (!empty($cta['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $cta['button']['title'] }}</span></div>
		@endif
	</div>
</div>
