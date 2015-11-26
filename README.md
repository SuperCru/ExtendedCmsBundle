SuperCruExtendedCmsBundle
================================

1) Installation
----------------------------------

SuperCruExtendedCmsBundle can conveniently be installed via Composer. Just run the following command from your project directory

composer require "supercru/extendedcmsbundle": "dev-master"

Now, Composer will automatically download all required files, and install them for you. All that is left to do is to update your AppKernel.php file, and register the new bundle:

<pre>
// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new SuperCru\ExtendedCmsBundle\ExtendedCmsBundle(),
    // ...
);
</pre>
