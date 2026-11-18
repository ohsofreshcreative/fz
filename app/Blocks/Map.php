<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Map extends Block
{
	public $name = 'Mapa';
	public $description = 'map';
	public $slug = 'map';
	public $category = 'formatting';
	public $icon = 'location';
	public $keywords = ['map', 'mapa'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$map = new FieldsBuilder('map');

		$map
			->setLocation('block', '==', 'acf/map') // ważne!
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_map', ['label' => ''])
			
			->addText('title', ['label' => 'Tytuł'])
			->addTextarea('code', [
				'label' => 'Kod mapy',
				'instructions' => 'Wklej kod mapy',
				'required' => 1,
			])

			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('whitebg', [
				'label' => 'Białe tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $map;
	}

	public function with()
	{
		return [
			'g_map' => get_field('g_map'),
			'flip' => get_field('flip'),
			'whitebg' => get_field('whitebg'),
		];
	}
}
