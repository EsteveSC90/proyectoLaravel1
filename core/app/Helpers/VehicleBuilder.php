<?php

namespace App\Helpers;

use App\Models\Vehicle;

class VehicleBuilder
{
    private Vehicle $vehicle;

    public function __construct()
    {
        $this->reset();
    }

    private function reset()
    {
        $this->vehicle = new Vehicle();
    }

    public function addWheels($wheels) {
        $this->vehicle->wheels = $wheels;
        return $this;
    }

    public function addColor($color) {
        $this->vehicle->color = $color;
        return $this;
    }

    public function addRegistration($registration) {
        $this->vehicle->registration = $registration;
        return $this;
    }

    public function build() {
        return $this->vehicle;
    }
}
