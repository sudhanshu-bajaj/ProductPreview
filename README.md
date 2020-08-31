# Magento 2 Admin Product Preview module
This module for Magento 2 admin to view the product frontend view. 

### Key Points:
- Module using direct action controller path to load product.
- Product with "Not Visible Individually" visibility status won't have action to view product. 

### Installation:

Download the source code and extract to app/code/Bajaj folder.

OR

Run the composer require command.

`composer require bajaj/product-preview`

`php bin/magento module:enable Bajaj_ProductPreview`

`php bin/magento setup:upgrade`

`php bin/magento cache:flush`


Please let me know if you have any query or issue regarding the module.
