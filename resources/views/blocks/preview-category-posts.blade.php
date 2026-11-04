<!--- category-posts preview --->
<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Baza wiedzy - Ostatnie wpisy</div>
			<span class="acf-preview__slug">acf/category-posts</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($posts_settings['title']))
		<p class="text-h5">{{ $posts_settings['title'] }}</p>
		@endif
		<p>Najnowsze wpisy z wybranej kategorii pobierane automatycznie.</p>
	</div>
</div>
