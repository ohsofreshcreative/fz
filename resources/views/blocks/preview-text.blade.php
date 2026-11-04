<!--- text preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Nagłówek i opis</div>
			<span class="acf-preview__slug">acf/text</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_text['subtitle']))
		<p class="text-h6">{{ wp_strip_all_tags($g_text['subtitle']) }}</p>
		@endif
		@if (!empty($g_text['header']))
		<p class="text-h5">{{ $g_text['header'] }}</p>
		@endif
		@if (!empty($g_text['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_text['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_text['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_text['button']['title'] }}</span></div>
		@endif
	</div>
</div>
