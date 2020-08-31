<?php

namespace Bajaj\ProductPreview\Ui\Component\Columns;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Url;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Catalog\Api\ProductRepositoryInterface;


/**
 * Class ProductGrid
 * @package Bajaj\ProductPreview\Ui\Component\Columns
 */
class ProductGrid extends Column
{

    const URL_PATH_VIEW = 'catalog/product/view';

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepositoryInterface;

    /** @var Url */
    protected $urlBuilder;

    /**
     * ProductGrid constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param ProductRepositoryInterface $productRepositoryInterface
     * @param Url $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        ProductRepositoryInterface $productRepositoryInterface,
        Url $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->urlBuilder                 = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     * @throws NoSuchEntityException
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $product = $this->productRepositoryInterface->getById($item['entity_id'], false);
                $visible = $product->getVisibility();
                $name    = $this->getData('name');
                // Don't show action if Visibility set to Not Visible Individually
                if ($visible != 1) {
                    $item[$name]['preview'] = [
                        'href'   => $this->urlBuilder->getUrl(self::URL_PATH_VIEW, ['id' => $item['entity_id'], '_nosid' => true]),
                        'target' => '_blank',
                        'label'  => __('View Product')
                    ];
                }
            }
        }
        return $dataSource;
    }
}
