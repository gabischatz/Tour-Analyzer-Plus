# Tour Analyzer Plus

**Tour Analyzer Plus** ist ein webbasiertes Werkzeug zur Analyse, Visualisierung und Vorbereitung von Tour- und Routendaten.

Das Tool arbeitet mit **GPX**, **GeoJSON** und OpenStreetMap-nahen Routendaten. Es hilft dabei, Touren auf einer Karte darzustellen, Wegpunkte und Streckenabschnitte zu prüfen und Daten für die weitere manuelle Bearbeitung vorzubereiten.

## Inhalt dieser ZIP

Diese ZIP enthält nur die Dateien für **Tour Analyzer Plus**:

```txt
tour-analyzer-plus.html
tour-analyzer-plus-anleitung.html
tour-analyzer-plus.png
tour-analyzer-plus1.png
proxy.php
README.md
LICENSE.md
LICENSE-CONTENT-CC-BY-SA-4.0.md
NOTICE-OSM.md
```

## Zweck

Tour Analyzer Plus soll helfen, Touren und Routen übersichtlich zu prüfen.

Typische Aufgaben sind:

- GPX-Dateien laden und darstellen
- GeoJSON-Daten laden und darstellen
- Routenverlauf auf einer Karte kontrollieren
- OSM-nahe Objekt- und Way-Daten auswerten
- Tourdaten für die weitere Bearbeitung vorbereiten
- GeoJSON-Dateien exportieren oder weiterverwenden

## Wichtiger Hinweis

Tour Analyzer Plus ist ein Analyse- und Vorbereitungstool.

Das Programm lädt keine Daten direkt nach OpenStreetMap hoch.  
Änderungen an OpenStreetMap-Daten müssen immer manuell geprüft und mit geeigneten Werkzeugen wie JOSM hochgeladen werden.

## Installation auf dem Webspace

Die Dateien können gemeinsam in einen Ordner auf dem Webspace kopiert werden, zum Beispiel:

```txt
/tour-analyzer-plus/
```

Danach kann die Anwendung im Browser geöffnet werden:

```txt
https://deine-domain.example/tour-analyzer-plus/tour-analyzer-plus.html
```

Die Anleitung liegt hier:

```txt
tour-analyzer-plus-anleitung.html
```

## Benötigte Dateien

Die Hauptdatei ist:

```txt
tour-analyzer-plus.html
```

Die Datei `proxy.php` wird benötigt, wenn Abfragen aus dem Browser wegen CORS oder Serverbeschränkungen nicht direkt funktionieren.

Die Bilddateien werden für Vorschau, Dokumentation oder Meta-/OpenGraph-Darstellung verwendet:

```txt
tour-analyzer-plus.png
tour-analyzer-plus1.png
```

## Datenschutz

Tour Analyzer Plus verarbeitet die geladenen Dateien grundsätzlich im Browser, soweit keine Serverabfrage über `proxy.php` genutzt wird.

Bei Nutzung von `proxy.php` werden Abfragen über den eigenen Webspace weitergeleitet. Der Betreiber des Webspaces ist für Datenschutz, Logs und Serverkonfiguration verantwortlich.

## OpenStreetMap-Hinweis

Dieses Projekt kann Daten aus OpenStreetMap verwenden oder darauf verweisen.

OpenStreetMap-Daten stehen unter der **Open Database License (ODbL) 1.0**.  
Die notwendige Namensnennung lautet:

```txt
© OpenStreetMap-Mitwirkende
```

Weitere Hinweise stehen in `NOTICE-OSM.md`.

## Lizenz

Der Programmcode steht unter der **MIT License**.  
Siehe `LICENSE.md`.

Grafiken, Dokumentation und beschreibende Inhalte stehen zusätzlich unter **CC BY-SA 4.0**, sofern sie nicht ausdrücklich anders gekennzeichnet sind.  
Siehe `LICENSE-CONTENT-CC-BY-SA-4.0.md`.

## Projektstatus

Stand dieser ZIP:

```txt
Tour Analyzer Plus v1.6.0
```

## Autor

```txt
Lutz Müller
```
