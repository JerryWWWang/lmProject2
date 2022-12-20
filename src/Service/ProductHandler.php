<?php

namespace App\Service;

use function PHPUnit\Framework\throwException;

class ProductHandler
{
    /**
     * 计算商品价格总和
     * @access public
     * @param array $products 商品数组
     * @return int|mixed
     */
    public function getTotalPriceQuickly($products)
    {
        try{
            return array_sum(array_column($products,'price'));
        }catch(\Exception $e) {
            throwException($e);
        }
    }

    /**
     * 将商品按照金额由大至小排序 并筛选出种类是dessert类型的商品
     * @access public
     * @param array $products 商品数组
     * @return array|mixed
     */
    public function getSortDessertProducts($products)
    {
        try{
            $sort = array_column($products, 'price');
            array_multisort($sort, SORT_DESC, $products);
            $dessertProducts = array();
            foreach ($products as $product) {
                if($product['type'] == 'Dessert') {
                    array_push($dessertProducts, $product);
                }
            }
            return $dessertProducts;
        }catch(\Exception $e) {
            throwException($e);
        }
    }

    /**
     * 将一个商品的创建日期转为 unix timestamp 格式
     * @access public
     * @param string $createDate 商品创建日期字符串
     * @return int|mixed
     */
    public function transformCreateDate($createDate)
    {
        try{
            ini_set('date.timezone', 'Asia/Shanghai');
            return strtotime($createDate);
        }catch(\Exception $e) {
            throwException($e);
        }
    }
}