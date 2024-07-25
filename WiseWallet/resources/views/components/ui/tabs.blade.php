@vite('resources/css/presupuesto/presupuesto.show.css')

@props(['tabId', 'tabNames' => []])
@php
    $tabBtnClasses = 'rounded-full text-gray-800 px-4 py-2 font-semibold hover:bg-gray-300';
@endphp

@if (isset($tabId))
    <div id="presupuesto-tabs" class="w-full">
        <div id="{{ $tabId }}-tabs-actions" class="flex gap-3 bg-gray-100 rounded-md py-4 px-7 mb-7">
            @foreach ($tabNames as $tabLabel)
                @php
                    static $tabIdx = 0;
                    $tabIdx++;
                @endphp
                @if ($loop->first)
                    <button class="tabActive {{ $tabBtnClasses }}" tabindex="{{ $tabIdx }}">{{ $tabLabel  }}</button>
                @else
                    <button class="{{ $tabBtnClasses }}" tabindex="{{$tabIdx}}">{{$tabLabel}}</button>
                @endif
            @endforeach
        </div>
        <div id="{{ $tabId }}-tab--info">
            {{ $slot }}
        </div>
    </div>
    <script>
        let tabItemBaseName = 'Tab';
        let tabsActionsBaeId = '{{ $tabId }}-tabs-actions';
        let tabsInfoId = '{{ $tabId }}-tab--info';
        const tabActive = 'tabActive';

        const setTabsItemsIds = () => {
            document.querySelectorAll(`#${tabsInfoId} > div[id*="Tab"]`).forEach((tabEle, i) => {
                console.log('tabItems', tabEle);
                tabEle.id = '{{ $tabId }}' + tabEle.id;
                tabEle.classList.add('wtab');
                if (i === 0) tabEle.classList.add('tab--active');
            });
        };

        function switchTabContent(tabId) {
            if (tabId != null) {
                console.log('CHANGEEEE ', tabId);
                const tabFound = document.querySelector(`#{{ $tabId }}${tabItemBaseName}${tabId}`);
                if (tabFound != null) {
                    if (!tabFound.classList.contains('tab--active')) {
                        document.querySelector(`#{{ $tabId }}-tab--info .tab--active`)?.classList.remove('tab--active');
                        tabFound.classList.add('tab--active');
                    }

                }
            }
        }

        document.querySelectorAll(`#${tabsActionsBaeId} button`).forEach(btn => btn.addEventListener('click',
            (e) => {
                const btnClicked = e.target;
                if (!btnClicked.classList.contains(tabActive)) {
                    document.querySelector(`#${tabsActionsBaeId} button.${tabActive}`)?.classList.remove(tabActive);
                    btnClicked.classList.add(tabActive);
                }
                switchTabContent(btnClicked.getAttribute('tabindex'));
            }));

        setTabsItemsIds();
    </script>
@endif