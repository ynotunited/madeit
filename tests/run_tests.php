<?php
require_once __DIR__ . '/../src/services/SimulationEngine.php';
require_once __DIR__ . '/../src/Router.php';

$passed = 0;
$failed = 0;

function assertTest($condition, $name) {
    global $passed, $failed;
    if ($condition) {
        $passed++;
        echo "[PASS] $name\n";
    } else {
        $failed++;
        echo "[FAIL] $name\n";
    }
}

// Test 1: SimulationEngine Basic
$engine = new SimulationEngine();
$result = $engine->simulate("I need a system with login and payments.");
assertTest(count($result['modules']) === 2, "SimulationEngine detects login and payments");
assertTest(strpos($result['cost_range'], '700') !== false, "SimulationEngine calculates base cost for auth+payments (200+500)");

// Test 2: SimulationEngine Fallback
$result2 = $engine->simulate("I just want a simple website");
assertTest(count($result2['modules']) === 1, "SimulationEngine uses fallback for unknown ideas");
assertTest($result2['modules'][0]['name'] === 'Core Architecture', "SimulationEngine fallback is Core Architecture");

// Test 3: Router class exists and can be instantiated
$router = new Router();
assertTest($router instanceof Router, "Router can be instantiated");

echo "\nTests Complete: $passed Passed, $failed Failed\n";
if ($failed > 0) exit(1);
exit(0);
