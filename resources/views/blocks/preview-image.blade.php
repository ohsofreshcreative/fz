<!--- image preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Obraz</div>
			<span class="acf-preview__slug">acf/image</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_image['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_image['image']['ID'], 'thumbnail') !!}</figure>
		@endif
	</div>
</div>
