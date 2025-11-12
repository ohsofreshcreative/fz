<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TwoColumns extends Block
{
	public $name = 'Dwie kolumny';
	public $description = 'TwoColumns';
	public $slug = 'twocolumns';
	public $category = 'formatting';
	public $icon = 'columns';
	public $keywords = ['twocolumns'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$twocolumns = new FieldsBuilder('twocolumns');

		$twocolumns
			->setLocation('block', '==', 'acf/twocolumns') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Dwie kolumny',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- FIELDS ---*/
			->addTab('Kolumna #1', ['placement' => 'top'])
			->addGroup('col1', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endGroup()

			/*--- GRUPA #2 ---*/
			->addTab('Kolumna #2', ['placement' => 'top'])
			->addGroup('col2', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addTextarea('where', [
				'label' => 'Gdzie',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addTextarea('when', [
				'label' => 'Kiedy',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addLink('button1', [
				'label' => 'Przycisk #1',
				'return_format' => 'array',
			])
			->addLink('button2', [
				'label' => 'Przycisk #2',
				'return_format' => 'array',
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);



		return $twocolumns;
	}

	public function with()
	{
		return [
			'col1' => get_field('col1'),
			'col2' => get_field('col2'),
			'flip' => get_field('flip'),
		];
	}
}
