<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Agenda extends Block
{
    public $name = 'Agenda2';
    public $description = 'Blok wyświetlający agendę z panelami w zakładkach.';
    public $slug = 'agenda';
	public $category = 'formatting';
	public $icon = 'align-pull-left';
	public $keywords = ['agenda', 'panel', 'zakładki'];
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
        $agenda = new FieldsBuilder('agenda');

        $agenda
            ->setLocation('block', '==', 'acf/agenda')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Agenda',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_textimg', ['label' => ''])
            ->addMessage('info', 'Ten blok automatycznie pobiera i wyświetla dane z zakładki Ustawienia -> Agenda. Poniższe ustawienia służą jedynie do kontroli wyglądu bloku.')

			->endGroup()
            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', [
                'label' => 'ID',
            ])
            ->addText('section_class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
            ->addTrueFalse('nomt', [
                'label' => 'Usunięcie marginesu górnego',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addSelect('background', [
                'label' => 'Kolor tła',
                'choices' => [
                    'none' => 'Brak (domyślne)',
                    'section-white' => 'Białe',
                    'section-light' => 'Jasne',
                    'section-gray' => 'Szare',
                    'section-brand' => 'Marki',
                    'section-gradient' => 'Gradient',
                    'section-dark' => 'Ciemne',
                ],
                'default_value' => 'none',
                'ui' => 0,
                'allow_null' => 0,
            ]);

        return $agenda;
    }

    public function with()
    {
        return [
            'agenda_data' => get_field('agenda', 'options'),
            'section_id' => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'nomt' => get_field('nomt'),
            'background' => get_field('background'),
        ];
    }
}