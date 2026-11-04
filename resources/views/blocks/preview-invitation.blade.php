<!--- invitation preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Zaproszenie</div>
			<span class="acf-preview__slug">acf/invitation</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_invitation['header']))
		<p class="text-h5">{{ $g_invitation['header'] }}</p>
		@endif
		@if (!empty($g_invitation['txt']))
		<p>{!! wp_trim_words(wp_strip_all_tags($g_invitation['txt']), 24) !!}</p>
		@endif
		@if (!empty($g2_invitation['r_invitation']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) ($g2_invitation['r_invitation'] ?? []), 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['img']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['img']['ID'], 'thumbnail') !!}</figure>
				@endif
				@if (!empty($item['title']))
				<p class="text-h5">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['txt']))
				<p>{!! wp_trim_words(wp_strip_all_tags($item['txt']), 24) !!}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		@if (!empty($g_invitation['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_invitation['button']['title'] }}</span></div>
		@endif
	</div>
</div>
