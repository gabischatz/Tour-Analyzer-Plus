<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Way ID von GET oder POST holen
$wayId = isset($_REQUEST['way_id']) ? intval($_REQUEST['way_id']) : 0;

if ($wayId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Ungültige Way ID.']);
    exit;
}

// 1. Die OSM XML direkt laden (Wichtig: /full am Ende für Koordinaten!)
$osmUrl = "https://www.openstreetmap.org/api/0.6/way/{$wayId}/full";

$context = stream_context_create([
    "http" => ["header" => "User-Agent: TourAnalyzerConverter/1.0\r\n"]
]);

$xmlString = file_get_contents($osmUrl, false, $context);

if ($xmlString === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Konnte Daten von OSM nicht laden.']);
    exit;
}

// 2. XML parsen
$xml = simplexml_load_string($xmlString);
$coordinates = [];

// Alle Nodes in ein Array speichern für schnellen Zugriff
$nodes = [];
foreach ($xml->node as $node) {
    $nodes[(string)$node['id']] = [
        (float)$node['lon'],
        (float)$node['lat']
    ];
}

// Koordinaten in der richtigen Reihenfolge des Ways sammeln
foreach ($xml->way->nd as $nd) {
    $ref = (string)$nd['ref'];
    if (isset($nodes[$ref])) {
        $coordinates[] = $nodes[$ref];
    }
}

// 3. GeoJSON ausgeben
$geojson = [
    'type' => 'Feature',
    'geometry' => [
        'type' => 'LineString',
        'coordinates' => $coordinates
    ],
    'properties' => [
        'way_id' => $wayId,
        'name' => (string)$xml->way->tag[0]['v'] // Optional: Ersten Tag als Name
    ]
];

echo json_encode($geojson, JSON_PRETTY_PRINT);
?>