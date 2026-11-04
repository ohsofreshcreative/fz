<!--- contact preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kontakt</div>
			<span class="acf-preview__slug">acf/contact</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_contact_1['title']))
		<p class="text-h5">{{ $g_contact_1['title'] }}</p>
		@endif
		@if (!empty($g_contact_1['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_contact_1['txt']), 24) !!}</p>
		@endif
		@if (!empty($g_contact_1['phone']))
		<p>{{ $g_contact_1['phone'] }}</p>
		@endif
		@if (!empty($g_contact_1['mail']))
		<p>{{ $g_contact_1['mail'] }}</p>
		@endif
		@if (!empty($g_contact_2['title']))
		<p class="text-h5">{{ $g_contact_2['title'] }}</p>
		@endif
		<p>Formularz kontaktowy.</p>
	</div>
</div>
