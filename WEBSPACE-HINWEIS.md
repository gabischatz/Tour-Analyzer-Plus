# Webspace-Struktur Tour Analyzer Plus v1.6.5

Zielordner auf dem Server:

```txt
/tour-analyzer-plus/
```

Startadresse:

```txt
https://overpass-osm.de.cool/tour-analyzer-plus/
```

Direkte Startdatei:

```txt
https://overpass-osm.de.cool/tour-analyzer-plus/index.html
```

Wichtig:

- `index.html` ist die eigentliche App.
- `tour-analyzer-plus.html` wurde entfernt, damit keine zweite Startdatei parallel existiert.
- Die Dokumentation und Screenshots liegen im selben Projektordner.
- `.htaccess` setzt `index.html` als DirectoryIndex, falls der Server Apache-Regeln unterstützt.


## Änderungen in v1.6.5

- Metadaten auf `https://overpass-osm.de.cool/tour-analyzer-plus/` korrigiert.
- App-Startdatei bleibt `index.html`.
- Hilfedatei heißt jetzt `hilfe.html`.
- Vorschau-/OpenGraph-Bild ist `tour-analyzer-plus.png`.
- Proxy wird relativ über `./proxy.php?url=` aufgerufen.


## Änderungen in v1.6.5

- `hilfe.html` wurde vollständig überarbeitet.
- Die Hilfeseite enthält jetzt die sieben Screenshots aus `docs/screenshots/`.
- Die Hilfe erklärt Start, Ortsbestimmung, Karte, Objektabfrage, OSM-Tags, Koordinatenpunkte und Export.


## Änderungen in v1.6.5

- `hilfe.html` nutzt jetzt zweispaltige Detail-Sektionen.
- Links steht der Erklärungstext, rechts der passende Screenshot.
- Screenshots starten oben bündig zur Sektion.
- Klick auf einen Screenshot öffnet ihn zentriert als Dialog/Lightbox.
