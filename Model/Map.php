<?php


namespace MapUx\Model;


class Map
{
    const DEFAULT_LAT = 44;
    const DEFAULT_LON = 0;
    const DEFAULT_ZOOM = 10;
    /**
     * @var float
     */
    private $centerLatitude;
    /**
     * @var float
     */
    private $centerLongitude;
    /**
     * @var int
     */
    private $zoomLevel;

    /**
     * @var Layer
     */
    private $layers;

    /**
     * @var array
     */
    private $markers;


    public function __construct(
        float $centerLatitude = self::DEFAULT_LAT,
        float $centerLongitude = self::DEFAULT_LON,
        int $zoomLevel = self::DEFAULT_ZOOM,
        string $background = null
    )
    {
        $this->setCenterLatitude($centerLatitude);
        $this->setCenterLongitude($centerLongitude);
        $this->setZoomLevel($zoomLevel);
        $background ? $this->addLayer(new Layer($background)) : $this->addLayer(new Layer());
    }

    public function isReady()
    {
        return (
            null !== $this->centerLatitude && is_float($this->centerLatitude) &&
            null !== $this->centerLongitude && is_float($this->centerLongitude) &&
            null !== $this->zoomLevel && is_integer($this->zoomLevel)
        );
    }

    /**
     * @param Layer $layer
     */
    public function addLayer(Layer $layer)
    {
        $this->layers[] = $layer;
    }

    /**
     * @return mixed
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * @return float
     */
    public function getCenterLatitude(): float
    {
        return $this->centerLatitude;
    }

    /**
     * @param float $centerLatitude
     */
    public function setCenterLatitude(float $centerLatitude): void
    {
        $this->centerLatitude = $centerLatitude;
    }

    /**
     * @return float
     */
    public function getCenterLongitude(): float
    {
        return $this->centerLongitude;
    }

    /**
     * @param float $centerLongitude
     */
    public function setCenterLongitude(float $centerLongitude): void
    {
        $this->centerLongitude = $centerLongitude;
    }

    /**
     * @return int
     */
    public function getZoomLevel(): int
    {
        return $this->zoomLevel;
    }

    /**
     * @param int $zoomLevel
     */
    public function setZoomLevel(int $zoomLevel): void
    {
        $this->zoomLevel = $zoomLevel;
    }

    public function addMarker(Marker $marker)
    {
        $this->markers[] = $marker;
    }

    public function setMarkers(array $markers)
    {
        $this->markers = $markers;
    }

    public function getMarkers()
    {
        $markers = [];
        if ($this->markers) {
            foreach ($this->markers as $marker) {
                $markers[] = [
                    'lat' => $marker->getLatitude(),
                    'lon' => $marker->getLongitude()
                ];
            }
        }
        return json_encode($markers);
    }


}