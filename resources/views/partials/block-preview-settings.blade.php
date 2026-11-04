@php
$previewSettings = [];
$viewVariables = get_defined_vars();
foreach ($viewVariables as $name => $value) {
	if (! is_bool($value) || ! $value || ! function_exists('get_field_object')) {
		continue;
	}
	$field = get_field_object($name, false, false, false);
	if (($field['type'] ?? null) === 'true_false') {
		$previewSettings[] = $field['label'] ?? ucfirst(str_replace('_', ' ', $name));
	}
}
$backgroundChoices = [
	'section-white' => 'Białe',
	'section-light' => 'Jasne',
	'section-gray' => 'Szare',
	'section-brand' => 'Marki',
	'section-gradient' => 'Gradient',
	'section-dark' => 'Ciemne',
];
$backgroundValue = $background ?? 'none';
if ($backgroundValue !== 'none' && isset($backgroundChoices[$backgroundValue])) {
	$previewSettings[] = 'Tło: ' . $backgroundChoices[$backgroundValue];
}
@endphp
@if (!empty($previewSettings))
<div class="acf-preview__settings" aria-label="Wybrane ustawienia bloku">
	@foreach ($previewSettings as $setting)
	<span @class([
		'acf-preview__setting',
		'acf-preview__setting--background' => str_starts_with($setting, 'Tło:'),
		'acf-preview__setting--nomt' => in_array($setting, ['Brak marginesu górnego', 'Usunięcie marginesu górnego'], true),
	])>{{ $setting }}</span>
	@endforeach
</div>
@endif
