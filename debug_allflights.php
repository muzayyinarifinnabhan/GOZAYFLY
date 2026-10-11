<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Flight;
use App\Models\Seat;

$flights = Flight::with('seats')->get();
foreach ($flights as $f) {
    $classes = $f->seats->groupBy('class')->map(fn($g) => $g->count());
    echo "Flight #{$f->id} '{$f->flight_number}' seat_class={$f->seat_class} total=" . $f->seats->count()
        . " classes=[" . $classes->map(fn($c, $k) => "$k:$c")->join(', ') . "]\n";
}