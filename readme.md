Droop7 !
===================

What is it ?
-------------
<b>Dr</b>upal <b>O</b>bject <b>o</b>riented <b>p</b>rogramming for version <b>7</b>.
You can consider this module like an abstract class. It contains all logic use by your child module. your project becomes easier to organize (features oriented) and more maintainable (IMHO).
This (work in progress) module is load at very first in your module stack.

How to install ?
-------------
1/ Clone the repository
2/ Extract the module in ```sites/all/modules``` and install it :
```
drush en droop7 -y
cd droop7
composer install
```
3/ Make the ```droop7/cache``` folder writable
4/ Generate your child module (<i>see the next section above</i>)

What your "child module" looks like ?
-------------
Take a look in ```droop7/samples```
Here is good child arborescence module :

myproject
- app
- - config
- - - config.xml
- - - services.xml
- - routing
- - - routes.php
- src
- - Test
- - - Module
- - - - TestFeature
- - - - - Resources
- - - - - -  views
- - - - - TestFeatureBuilder.php
- - - - - TestFeatureController.php
- - - - - TestFeatureProcess.php

In future, this module must be auto-generate for you !

What's next ?
-------------
Auto-generate your child module, ready to work.