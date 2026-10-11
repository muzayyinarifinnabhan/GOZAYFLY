<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Flight;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

foreach ([4] as $fid) {
    $f = Flight::find($fid);
    echo "Flight #$fid seat_class={$f->seat_class} seats_total={$f->seats_total}\n";

    $byClass = Seat::where('flight_id', $fid)->get()->groupBy('class');
    foreach ($byClass as $class => $seats) {
        $avail = $seats->where('available', true)->count();
        echo "  class=$class total=" . $seats->count() . " available=$avail\n";
    }
    $rows = Seat::where('flight_id', $fid)->orderBy('seat_row')->orderBy('seat_col')->get();
    echo "  sample rows: " . $rows->map(fn($s) => $s->seat_number . ':' . $s->class)->slice(0, 12)->join(', ') . " ...\n";
    echo "  distinct rows: " . $rows->pluck('seat_row')->unique()->values()->join(',') . "\n";
}