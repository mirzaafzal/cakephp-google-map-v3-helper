<?php

App::import('Helper', 'Tools.GoogleMapV3');
App::import('Vendor', 'MyCakeTestCase');

class GoogleMapHelperTest extends MyCakeTestCase {
	
	function startCase() {
		$this->GoogleMap = new GoogleMapV3Helper();
		$this->GoogleMap->initHelpers();
	}
	
	function tearDown() {
		
	}
	
	function testObject() {
		$this->assertTrue(is_a($this->GoogleMap, 'GoogleMapV3Helper'));
	}
	
	function testStaticPaths() {
		echo '<h3>Paths</h3>';
		$m = $this->pathElements = array(
			array(
				'path' => array('Berlin', 'Stuttgart'),
				'color' => 'green',
			),
			array(
				'path' => array('44.2,11.1', '43.1,12.2', '44.3,11.3', '43.3,12.3'),
			),
			array(
				'path' => array(array('lat'=>'48.1','lng'=>'11.1'), array('lat'=>'48.4','lng'=>'11.2')), //'Frankfurt'
				'color' => 'red',
				'weight' => 10
			)
		);
		
		$is = $this->GoogleMap->staticPaths($m);
		echo pr(h($is));
		
		
		$options = array(
			'paths' => $is
		);
		$is = $this->GoogleMap->staticMapLink($options);
		echo h($is);
		
		$is = $this->GoogleMap->staticMap($options);
		echo $is;
	}
	
	function testStaticMarkers() {
		echo '<h3>Markers</h3>';
		$m = $this->markerElements = array(
			array(
				'address' => '44.3,11.2',
			),
			array(
				'address' => '44.2,11.1',
			)
		);
		$is = $this->GoogleMap->staticMarkers($m, array('color'=>'red', 'char'=>'C', 'shadow'=>'false'));
		echo returns(h($is));
		
		$options = array(
			'markers' => $is
		);
		$is = $this->GoogleMap->staticMap($options);
		echo h($is);
		echo $is;
	}
		
//	http://maps.google.com/staticmap?size=500x500&maptype=hybrid&markers=color:red|label:S|48.3,11.2&sensor=false
//	http://maps.google.com/maps/api/staticmap?size=512x512&maptype=roadmap&markers=color:blue|label:S|40.702147,-74.015794&markers=color:green|label:G|40.711614,-74.012318&markers=color:red|color:red|label:C|40.718217,-73.998284&sensor=false	
		
	function testStatic() {
		echo '<h3>StaticMap</h3>';
		$m = array(
			array(
				'address' => 'Berlin',
				'color' => 'yellow',
				'char' => 'Z',
				'shadow' => 'true'
			),
			array(
				'lat' => '44.2',
				'lng' => '11.1',
				'color' => '#0000FF',
				'char' => '1',
				'shadow' => 'false'
			)
		);
		
		$options = array(
			'markers' => $this->GoogleMap->staticMarkers($m)
		);
		echo returns(h($options['markers'])).BR;
		
		$is = $this->GoogleMap->staticMapLink($options);
		echo h($is);
		echo BR;
		
		$is = $this->GoogleMap->staticMap($options);
		echo h($is).BR;
		echo $is;
		echo BR.BR;
		
		$options = array(
			'size' => '200x100',
			'center' => true
		);
		$is = $this->GoogleMap->staticMapLink($options);
		echo h($is);
		echo BR.BR;
		$attr = array(
			'title'=>'Yeah'
		);
		$is = $this->GoogleMap->staticMap($options, $attr);
		echo h($is).BR;
		echo $is;
		echo BR.BR;
		
		$url = $this->GoogleMap->link(array('to'=>'Munich, Germany'));
		echo h($url);
		echo BR.BR;
		
		$pos = array(
			array('lat'=>48.1, 'lng'=>'11.1'),
			array('lat'=>48.2, 'lng'=>'11.2'),
		);
		$options = array(
			'markers' => $this->GoogleMap->staticMarkers($pos)
		);
		$attr = array('url'=>$this->GoogleMap->link(array('to'=>'Munich, Germany')));
		$is = $this->GoogleMap->staticMap($options, $attr);
		echo h($is).BR;
		echo $is;
		
		echo BR.BR;
		
		$url = $this->GoogleMap->link(array('to'=>'Munich, Germany'));
		$attr = array(
			'title'=>'Yeah'
		);
		$image = $this->GoogleMap->staticMap($options, $attr);
		$link = $this->GoogleMap->Html->link($image, $url, array('escape'=>false, 'target'=>'_blank'));
		echo h($link).BR;
		echo $link;
	}
	
	
	
	/**
	 * with default options
	 * 2010-12-18 ms
	 */
	function testDynamic() {
		echo '<h3>Map 1</h3>';
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
		//echo $this->GoogleMap->map($defaul, array('style'=>'width:100%; height: 800px'));
		echo '<script type="text/javascript" src="'.$this->GoogleMap->apiUrl().'"></script>';
		
		$options = array(
    );
    $result = $this->GoogleMap->map($options);
    $this->GoogleMap->addMarker(array('lat'=>48.69847,'lng'=>10.9514, 'title'=>'Marker', 'content'=>'Some Html-<b>Content</b>'));
    
    $this->GoogleMap->addMarker(array('lat'=>47.69847,'lng'=>11.9514, 'title'=>'Marker2', 'content'=>'Some more Html-<b>Content</b>'));
		
		
		$this->GoogleMap->addMarker(array('lat'=>47.19847,'lng'=>11.1514, 'title'=>'Marker3'));
		
		/*
		$options = array(
        'lat'=>48.15144,
        'lng'=>10.198,
        'content'=>'Thanks for using this'
    );
		$this->GoogleMap->addInfoWindow($options);
		//$this->GoogleMap->addEvent();
		*/
		
		$result .= $this->GoogleMap->script();
		
		echo $result;
	}
	
	
	/**
	 * more than 100 markers and it gets reaaally slow...
	 * 2010-12-18 ms
	 */
	function testDynamic2() {
		echo '<h3>Map 2</h3>';
		$options = array(
        'height'=>'111',
        'div' => array('id'=>'someother'),
        'map' => array('type'=>'H', 'typeOptions' => array('style'=>'DROPDOWN_MENU', 'pos'=>'RIGHT_CENTER'))
    );
    echo $this->GoogleMap->map($options);
    $this->GoogleMap->addMarker(array('lat'=>47.69847,'lng'=>11.9514, 'title'=>'Marker2', 'content'=>'Some more Html-<b>Content</b>'));
    
    for($i = 0; $i < 100; $i++) {
    	$lat = mt_rand(46000, 54000) / 1000;
    	$lng = mt_rand(2000, 20000) / 1000;
    	$this->GoogleMap->addMarker(array('lat'=>$lat,'lng'=>$lng, 'title'=>'Marker2', 'content'=>'Lat: <b>'.$lat.'</b><br>Lng: <b>'.$lng.'</b>'));
    }

    echo $this->GoogleMap->script();
    
    
	}
	
}
