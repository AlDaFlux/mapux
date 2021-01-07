<?php


namespace MapUx\Model;

use MapUx\Model\Shape;

final class Polyline extends GeojsonLayer
{
    const SHAPE_TYPE = 'polyline';

    private $structure = '{
          "type": "FeatureCollection",
          "features": [
            {
              "type": "Feature",
              "properties": {},
              "geometry": {
                "type": "LineString",
                "coordinates": []
              }
            }
          ]
        }';

    public function __construct(array $points)
    {
        parent::__construct('');
        $this->setType(self::SHAPE_TYPE);
        $this->points = $points;
        $this->makeJson();
    }

    private function makeJson()
    {
        $json = json_decode($this->structure, true);
        $json['features'][0]['geometry']['coordinates'] = $this->points;

        $this->setJson($json);
    }


}