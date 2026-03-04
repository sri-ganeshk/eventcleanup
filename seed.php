<?php
/**
 * seed.php — Script to populate the database with dummy events for showcasing.
 * Run this from the command line: php seed.php
 * Or simply open it in the browser once: http://localhost:8000/seed.php
 */

require_once __DIR__ . '/config.php';

echo "Clearing old events...\n<br>";
$db->trips->drop();

echo "Inserting sample events...\n<br>";

$sampleEvents = [
    [
        'name'     => "Central Park Spring Cleanup",
        'location' => "Central Park, Main Entrance",
        'date'     => new MongoDB\BSON\UTCDateTime((time() + 86400 * 3) * 1000), // 3 days from now
        'zip'      => "10024",
        'phone'    => "+1 (555) 123-4567",
        'map'      => "https://goo.gl/maps/example1",
        'des'      => "Join us for our annual spring cleanup! We'll be focusing on the picnic areas and walking trails. Gloves and trash bags will be provided.",
        'lat'      => null,
        'lng'      => null,
        'dt'       => new MongoDB\BSON\UTCDateTime()
    ],
    [
        'name'     => "Coastal Beach Rescue",
        'location' => "Sunset Beach Pavilion",
        'date'     => new MongoDB\BSON\UTCDateTime((time() + 86400 * 10) * 1000), // 10 days from now
        'zip'      => "90210",
        'phone'    => "+1 (555) 987-6543",
        'map'      => "https://goo.gl/maps/example2",
        'des'      => "Help us keep our oceans clean. We'll be removing plastics and debris from the shoreline. Please bring your own reusable water bottle.",
        'lat'      => null,
        'lng'      => null,
        'dt'       => new MongoDB\BSON\UTCDateTime()
    ],
    [
        'name'     => "Downtown Graffitti Removal",
        'location' => "City Square Plaza",
        'date'     => new MongoDB\BSON\UTCDateTime((time() + 86400 * 15) * 1000), // 15 days from now
        'zip'      => "600001",
        'phone'    => "+91 98765 43210",
        'map'      => "https://goo.gl/maps/example3",
        'des'      => "A coordinated effort to clean up local storefronts and public walls in the downtown district. Cleaning supplies provided by the city council.",
        'lat'      => null,
        'lng'      => null,
        'dt'       => new MongoDB\BSON\UTCDateTime()
    ]
];

$result = $db->trips->insertMany($sampleEvents);

echo "Successfully inserted " . $result->getInsertedCount() . " events!\n<br>";
echo "<a href='index.php'>Go to Home Page -></a>";
