<?php
// -------------------------------------------------------
// proxy.php — CORS-Proxy für den Tour Analyzer
// Lädt eine externe Datei (GeoJSON, GPX oder OSM-XML) serverseitig
// und gibt sie direkt an den Browser weiter.
// Der Browser sieht nur gabischatz.de.cool → kein CORS-Problem.
//
// Aufruf: proxy.php?url=https://...
// -------------------------------------------------------

// Nur GET-Anfragen erlauben
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// URL-Parameter prüfen
if (empty($_GET['url'])) {
    http_response_code(400);
    exit('Fehlender Parameter: url');
}

$url = $_GET['url'];

// Dekodiere URL (falls doppelt kodiert)
$url = urldecode($url);

// Sicherheit: Nur https:// erlauben — keine lokalen Dateien, kein http://
if (!preg_match('#^https://#i', $url)) {
    http_response_code(403);
    exit('Nur HTTPS-URLs erlaubt');
}

// Sicherheit: Erlaubte Domains (Whitelist)
// Hier: openstreetmap.org für die API, sowie deine eigenen Domains
$erlaubteDomains = [
    'overpass-osm.de.cool',
    'gabischatz.de.cool',
    'www.openstreetmap.org',     // OSM-API für XML
    'openstreetmap.org',          // ohne www
    'api.openstreetmap.org',      // falls mal verwendet
];

$host = parse_url($url, PHP_URL_HOST);
if (!in_array($host, $erlaubteDomains)) {
    http_response_code(403);
    exit('Domain nicht erlaubt: ' . htmlspecialchars($host));
}

// Datei serverseitig laden mit cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);   // Weiterleitungen folgen
curl_setopt($ch, CURLOPT_TIMEOUT, 15);             // Max. 15 Sekunden warten
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);    // SSL-Zertifikat prüfen
curl_setopt($ch, CURLOPT_USERAGENT, 'TourAnalyzer-Proxy/1.0');

// Wichtig: OSM-API akzeptiert nur bestimmte User-Agents
// Setze einen Browser-User-Agent für bessere Kompatibilität
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

$inhalt = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$fehler = curl_error($ch);
curl_close($ch);

// Fehler beim Laden?
if ($fehler) {
    http_response_code(502);
    exit('cURL-Fehler: ' . $fehler);
}

if ($httpCode !== 200) {
    http_response_code($httpCode);
    exit('Fehler beim Laden der Datei: HTTP ' . $httpCode);
}

// Content-Type anhand der Dateiendung oder des Inhalts setzen
$endung = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

// OSM-XML hat die Endung .xml (wenn aus der API)
if ($endung === 'xml' || strpos($inhalt, '<osm') !== false) {
    header('Content-Type: application/xml; charset=utf-8');
} elseif ($endung === 'geojson' || $endung === 'json') {
    header('Content-Type: application/geo+json; charset=utf-8');
} elseif ($endung === 'gpx') {
    header('Content-Type: application/gpx+xml; charset=utf-8');
} elseif ($endung === 'kml') {
    header('Content-Type: application/vnd.google-earth.kml+xml; charset=utf-8');
} elseif ($endung === 'tcx') {
    header('Content-Type: application/vnd.garmin.tcx+xml; charset=utf-8');
} else {
    header('Content-Type: application/octet-stream');
}

// CORS-Header damit der Browser die Antwort akzeptiert
header('Access-Control-Allow-Origin: *');
// Kein Caching — immer frische Daten
header('Cache-Control: no-store');

// Inhalt ausgeben
echo $inhalt;
?>