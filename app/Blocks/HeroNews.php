<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroNews extends Block
{
	public $name = 'Hero - Newsletter';
	public $description = 'hero-news';
	public $slug = 'hero-news';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$hero_news = new FieldsBuilder('hero-news');

		$hero_news
			->setLocation('block', '==', 'acf/hero-news') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero - Newsletter',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_hero_news', ['label' => 'Hero - Newsletter'])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
				'required' => 1,
			])
			->addText('header', [
				'label' => 'Nagłówek',
			])
			->addWysiwyg('text', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->addAccordion('accordion2', [
				'label' => 'Newsletter',
				'open' => false,
				'multi_expand' => true,
			])

			->addText('title', [
				'label' => 'Tytuł',
			])
			->addWysiwyg('opis', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->addText('shortcode', [
				'label' => 'Kod newslettera',
				'instructions' => 'Wklej shortcode formularza, np. [contact-form-7 id="84690e3" title="Contact form 1"]',
			])


			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $hero_news;
	}

	public function with()
	{
		return [
			'g_hero_news' => get_field('g_hero_news'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
		];
	}
}
