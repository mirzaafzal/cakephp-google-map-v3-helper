<?php

App::import('Helper', 'Tools.GoogleMapV3');
App::import('Lib', 'Tools.MyCakeTestCase');

class GoogleMapHelperTest extends MyCakeTestCase {

	function startCase() {
		$this->GoogleMapV3 = new GoogleMapV3Helper();
		$this->GoogleMapV3->initHelpers();
		
		Configure::write('Google', false);
	}

	function tearDown() {

	}

	function testObject() {
		$this->assertTrue(is_a($this->GoogleMapV3, 'GoogleMapV3Helper'));
	}

	


	/**
	 * reports about broken helper
	 * @see http://www.dereuromark.de/2010/12/21/googlemapsv3-cakephp-helper/
	 * 2011-10-12 ms
	 */
	function testIfBroken() {
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
		//echo $this->GoogleMapV3->map($defaul, array('style'=>'width:100%; height: 800px'));
		echo '<script type="text/javascript" src="'.$this->GoogleMapV3->apiUrl().'"></script>';
		echo '<script type="text/javascript" src="'.$this->GoogleMapV3->gearsUrl().'"></script>';

		echo '<h2>Map</h2>';		
		
		$options = array(
			//'autoCenter' => true,
			'zoom'=>8,
			'div' => array('id'=>'someother'), 
			'map' => array()
		);
		echo $this->GoogleMapV3->map($options);
		$this->GoogleMapV3->addMarker(array('lat'=>47.69847,'lng'=>11.9514, 'title'=>'MarkerMUC', 'content'=>'Some more Html-<b>Content</b>'));
	
		
		echo $this->GoogleMapV3->script();

		
	}

}