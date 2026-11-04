<!--- table preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tabela</div>
			<span class="acf-preview__slug">acf/table</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_table['header']))
		<p class="text-h5">{{ $g_table['header'] }}</p>
		@endif
		@if (!empty($g_table['r_table']))
		<div class="acf-preview__grid">
			@foreach (array_slice((array) $g_table['r_table'], 0, 3) as $item)
			<div class="acf-preview__card">
				@if (!empty($item['col1']))
				<p class="text-h5">{{ $item['col1'] }}</p>
				@endif
				@if (!empty($item['col2']))
				<p>{{ $item['col2'] }}</p>
				@endif
				@if (!empty($item['col3']))
				<p>{{ $item['col3'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
