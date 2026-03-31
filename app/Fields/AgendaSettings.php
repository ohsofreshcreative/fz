<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AgendaSettings extends Field
{
    public function fields(): array
    {
        $agenda_settings = new FieldsBuilder('agenda_settings');

        $agenda_settings
            ->setLocation('options_page', '==', 'agenda-settings')
            ->addTab('Treść', ['placement' => 'top'])
            ->addGroup('agenda', ['label' => 'Ustawienia Agendy'])
                ->addText('header1', ['label' => 'Nadtytuł'])
                ->addText('header2', ['label' => 'Tytuł'])
                ->addLink('btn1', [
                    'label' => 'Przycisk',
                    'return_format' => 'array',
                ])
                ->addRepeater('tabs', [
                    'label' => 'Dni Agendy (taby)',
                    'button_label' => 'Dodaj dzień',
                    'layout' => 'block',
                ])
                    ->addText('day', ['label' => 'Dzień (np. Dzień 1)'])
                    ->addText('date', ['label' => 'Data (np. 10.10.2024)'])
                    ->addRepeater('panels', [
                        'label' => 'Panele w danym dniu',
                        'button_label' => 'Dodaj panel',
                        'layout' => 'table', // Zmieniono z 'table' na 'block' dla lepszej czytelności
                    ])
                        ->addWysiwyg('paneltime', ['label' => 'Godzina', 'toolbar' => 'basic', 'media_upload' => 0, 'wrapper' => ['width' => '15']])
                        ->addWysiwyg('paneltitle', ['label' => 'Tytuł panelu', 'toolbar' => 'basic', 'media_upload' => 0, 'wrapper' => ['width' => '15']])
                        ->addWysiwyg('panelauthor', ['label' => 'Autorzy', 'toolbar' => 'basic', 'media_upload' => 0, 'wrapper' => ['width' => '15']])
                        ->addRepeater('extra_rows', [
                            'label' => 'Dodatkowe wiersze (np. przerwa kawowa)',
                            'button_label' => 'Dodaj wiersz',
                            'layout' => 'table',
							'wrapper' => ['width' => '50']
                        ])
                            ->addWysiwyg('txt1', ['label' => 'Kolumna 1', 'toolbar' => 'basic', 'media_upload' => 0])
                            ->addWysiwyg('txt2', ['label' => 'Kolumna 2', 'toolbar' => 'basic', 'media_upload' => 0])
                            ->addWysiwyg('txt3', ['label' => 'Kolumna 3', 'toolbar' => 'basic', 'media_upload' => 0])
                        ->endRepeater()
                    ->endRepeater()
                ->endRepeater()
            ->endGroup();

        return [$agenda_settings]; // <-- TO JEST POPRAWKA
    }
}