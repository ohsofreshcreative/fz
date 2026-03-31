@php
$sectionClass = $section_class ?? '';
$sectionClass .= $nomt ? ' !mt-0' : '';

if (!empty($background) && $background !== 'none') {
    $sectionClass .= ' ' . $background;
}
@endphp

@if (!empty($agenda_data))
<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-agenda relative py-12 lg:py-24 {{ $sectionClass }}">
    <div class="__wrapper c-main relative">
        <div class="text-center">
            @if (!empty($agenda_data['header1']))
                <p data-gsap-element="subtitle" class="subtitle-s tabs__h6">{{ $agenda_data['header1'] }}</p>
            @endif
            @if (!empty($agenda_data['header2']))
                <h2 data-gsap-element="header" class="m-header tabs__h3">{{ $agenda_data['header2'] }}</h2>
            @endif
        </div>

        @if (!empty($agenda_data['btn1']['url']))
            <div data-gsap-element="btn" class="flex justify-center mt-8">
                <div class="second-btn">
                    <a href="{{ $agenda_data['btn1']['url'] }}" target="{{ $agenda_data['btn1']['target'] ?? '_self' }}">{{ $agenda_data['btn1']['title'] }}</a>
                </div>
            </div>
        @endif

        @if (!empty($agenda_data['tabs']))
        <div class="mt-12" x-data="{ activeTab: 0 }">
            {{-- Tab Buttons --}}
            <div class="flex justify-center flex-wrap gap-4 mb-10">
                @foreach($agenda_data['tabs'] as $index => $tab)
                    <button
                        class="tab_btn"
                        :class="{ 'active': activeTab === {{ $index }} }"
                        @click="activeTab = {{ $index }}"
                    >
                        <p class="tab_btn__day">{{ $tab['day'] }}</p>
                        <p class="tab_btn__date">{{ $tab['date'] }}</p>
                    </button>
                @endforeach
            </div>

            {{-- Tab Content --}}
            @foreach($agenda_data['tabs'] as $index => $tab)-
                <div class="content_box" x-show="activeTab === {{ $index }}" x-cloak>
                    @if (!empty($tab['panels']))
                        @foreach($tab['panels'] as $panel)
                            {{-- Main Panel Row --}}
                            @if (!empty($panel['paneltitle']))
                                <div class="agenda__elements agenda__elements--bg">
                                    <div class="agenda__elements__one">
                                        {!! $panel['paneltime'] !!}
                                    </div>
                                    <div class="agenda__elements__two">
                                        {!! $panel['paneltitle'] !!}
                                    </div>
                                    <div class="agenda__elements__three">
                                        {!! $panel['panelauthor'] !!}
                                    </div>
                                </div>
                            @endif

                            {{-- Extra Rows (sub-items) --}}
                            @if (!empty($panel['extra_rows']))
                                @foreach($panel['extra_rows'] as $extra)
                                    <div class="agenda__elements">
                                        <div class="agenda__elements__one">
                                            {!! $extra['txt1'] !!}
                                        </div>
                                        <div class="agenda__elements__two">
                                            {!! $extra['txt2'] !!}
                                        </div>
                                        <div class="agenda__elements__three">
                                            {!! $extra['txt3'] !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        @if (!empty($agenda_data['btn1']['url']))
            <div data-gsap-element="btn" class="flex justify-center mt-12">
                <div class="second-btn">
                    <a href="{{ $agenda_data['btn1']['url'] }}" target="{{ $agenda_data['btn1']['target'] ?? '_self' }}">{{ $agenda_data['btn1']['title'] }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@else
    @if (isset($is_preview) && $is_preview)
        <div class="p-4 bg-red-100 text-red-800">
            <p>Blok Agenda: Dane nie zostały jeszcze wprowadzone. Przejdź do Ustawienia -> Agenda, aby dodać treść.</p>
        </div>
    @endif
@endif