CakePHP GoogleMapV3 helper / wrapper
======================================
v1.3
@cakephp 2.x

new in v1.3:
- url() and link() are now mapUrl() and mapLink() to be E_STRICT compliant
- all displayed urls are now properly escaped using urlencode() and h()

most important changes
- mapLink() creates now actual links - use mapUrl() for urls
- staticMapUrl() and staticMapLink() for static non-js (image only) maps.
- usage of array containers in order to use custom js more easily
- geolocate-feature for state-of-the-art-browsers
- custom icons

for most current manual see
- http://www.dereuromark.de/2010/12/21/googlemapsv3-cakephp-helper/
- the test case (contains several use cases!)


## DEPPRECATED AS STANDALONE PLUGIN

Please use the version in  my Tools Plugin:
https://github.com/dereuromark/tools/tree/2.0/View/Helper/
