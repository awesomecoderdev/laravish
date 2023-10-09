
{{__('Guten Tag')}}<br/>
<p>
{{__('Ihre fas-ID:')}} {{ $sighting->tag_id }} {{__('wurde gefunden')}}<br/>


    {{__('von')}} {{ $sighting->contact }}<br/>
    {{__('Nachricht:')}} {{ $sighting->message }}<br/>
    {{__('GPS-Koordinaten:')}} {!! $sighting->getGPS() !!}
</p><p>
    {{__('Bitte kontaktieren Sie den Absender.
    Hausschlüssel und dergleichen sollten Sie nicht
    an eine Adresse senden lassen, wo sie Schaden
    anrichten könnten.')}}
</p><p>
    {{__('Seien Sie dankbar gegenüber dem Finder/ der
    Finderin dankbar und honorieren dies nach der
    Übergabe mit 10% Finderlohn.')}}
</p>
<p>
    {{__('Freundliche Grüße')}}<br/>
    {{__('Found and Scan Team - Your personal lost')}}<br/>
    {{__('property service 4.0')}}
</p>
