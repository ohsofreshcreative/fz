<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Logos extends Block
{
	public $name = 'Logotypy';
	public $description = 'logos';
	public $slug = 'logos';
	public $category = 'formatting';
	public $icon = 'image-flip-horizontal';
	public $keywords = ['logos', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$logos = new FieldsBuilder('logos');

		$logos
			->setLocation('block', '==', 'acf/logos')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Logotypy',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_logos', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])
			->addTextarea('txt', [
				'label' => 'Opis',
				'rows' => 4,
				'placeholder' => 'Wpisz opis...',
				'new_lines' => 'br',
			])
			->addGallery('logos_gallery', [
				'label' => 'Galeria logotypów',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'insert' => 'append',
				'library' => 'all',
				'min' => 1,
			])
			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('lightbg', [
				'label' => 'Jasne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $logos;
	}

	public function with()
	{
		$group = get_field('g_logos') ?: [];

		return [
			'g_logos' => $group,
			'logos' => $group['logos_gallery'] ?? [],
			'flip' => get_field('flip'),
			'lightbg' => get_field('lightbg'),
			'nomt' => get_field('nomt'),
		];
	}
}
