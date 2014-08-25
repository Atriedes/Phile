<?php

// use this config file to overwrite the defaults from default_config.php
// or to make local config changes.
$config = array();
// run the generator.php file or fill this with a long string
// must not be empty
$config['encryptionKey'] = '217f1lYIxOLaDvLeCvD7P(IYoMOhPE|Y[4)ZLtu9uvo34MaBEeiYLx(=89EBWcXl';

// it is important to return the $config array!

// set the theme for this installation
$config['theme'] = 'blog';

// set some defaults for the pages
$config['date_format'] = 'jS F, Y'; // 11th November, 2013
$config['pages_order_by'] = 'date'; // this is a blog so date ordering
$config['pages_order'] = 'desc';

// disable the cache for this theme since we are in development
$config['plugins'] = array(
  'philePhpFastCache' => array('active' => false),
  'phileSimpleFileDataPersistence' => array('active' => false)
);
return $config;
