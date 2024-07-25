<?php 
interface WeatherObserverObserver {
    public function update($temperature, $humidity, $pressure);
}

interface WeatherSubjectObserver {
    public function attach(WeatherObserverObserver $observer);
    public function detach(WeatherObserverObserver $observer);
    public function notify();
}

class WeatherStationEastObserver implements WeatherSubjectObserver {
    private $observers = [];
    private $temperature;
    private $humidity;
    private $pressure;

    public function attach(WeatherObserverObserver $observer) {
        $this->observers[] = $observer;
    }

    public function detach(WeatherObserverObserver $observer) {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    public function updateMeasurements($temperature, $humidity, $pressure) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        echo "\n\nWeather station measurements have been updated\n";

        $this->notify();
    }
}

