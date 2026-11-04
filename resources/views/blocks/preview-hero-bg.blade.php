<!--- hero-bg preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Tło</div>
			<span class="acf-preview__slug">acf/hero-bg</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_herobg['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_herobg['image']['ID'], 'thumbnail') !!}</figure>
		@endif
		@if (!empty($g_herobg['title']))
		<p class="text-h5">{{ $g_herobg['title'] }}</p>
		@endif
	</div>
</div>
