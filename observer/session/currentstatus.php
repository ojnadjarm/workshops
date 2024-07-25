<?php
require_once __DIR__ . '/observer.php';

class CurrentStatus implements WeatherObserverObserver {
    private $temperature;
    private $humidity;
    private $pressure;

    public function update($temperature, $humidity, $pressure) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->display();
    }

    public function display() {
        echo "Current temperature: $this->temperature\n";
        echo "Current humidity: $this->humidity\n";
        echo "Current pressure: $this->pressure\n";
    }
}

class ItsTooHot implements WeatherObserverObserver {
    private $temperature;
    private $humidity;
    private $pressure;

    public function update($temperature, $humidity, $pressure) {
        if ($temperature > 30) {
            $this->display('It is too hot');
        }
    }

    public function display($string) {
        echo $string . "\n";
    }
}

$weatherStation = new WeatherStationEastObserver();
$currentstationclass = 'CurrentStatus';
$currentStatus = new $currentstationclass();
$cussrentstatusmethod = 'update';
$currentStatus->$cussrentstatusmethod(30, 65, 30.4);

$weatherStation->attach($currentStatus);
$weatherStation->attach($errorObserver);
$weatherStation->updateMeasurements(30, 65, 30.4);
$weatherStation->detach($currentStatus);
$weatherStation->updateMeasurements(32, 70, 29.2);
