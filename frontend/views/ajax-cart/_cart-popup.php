<?php 

use common\components\UrlUtil;

/* @var int $cartQuantity */
?>

<div class="cart-popup">
    <div class="cart-header"><span>Giỏ hàng hiện có <b style="color:red;"><?= $cartQuantity;?></b> mặt hàng </span></div>
    <div class="list_product">
        <table>
            <tbody>
                <tr>
                    <th colspan="2" class="product-name">Sản phẩm</th>
                    <th class="product-price">Giá</th>
                    <th class="product-number">Số lượng</th>
                    <th class="product-price">Tổng</th>
                    <th class="product-delete">&nbsp;</th>
                </tr>
                <?php foreach($cartProducts as $cartProduct) : ?>
                    <tr>
                        <td class="product-img">
                            <img src="<?= $cartProduct->product->image; ?>" alt="" width="80" height="72" />
                        </td>
                        <td class="product-text">
                            <?= $cartProduct->product->name; ?>
                        </td>
                        <td class="product-price">
                            <span class="new">
                                <?= Yii::$app->formatter->asDecimal($cartProduct->product->price); ?>
                            </span> VNĐ
                        </td>
                        <td class="product-number">
                            <input class="product-quantity" data-id="<?= $cartProduct->product->id;?>" type="number" style="width: 50px;"
                                   value="<?= $cartProduct->quantity; ?>" min="1" />
                        </td>
                        <td class="product-total-price">
                            <?= Yii::$app->formatter->asDecimal($cartProduct->total_price); ?> VNĐ
                        </td>
                        <td class="product-delete">
                            <a href="javascript:;" class="delete-product" title="Xóa" data-id="<?= $cartProduct->product->id; ?>">
                                X
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- end .list_product -->
    <div class="payment">
        <div class="payment-right">
            <p class="total">
                <span>Tổng cộng: </span>
                <?= Yii::$app->formatter->asDecimal($totalPrice); ?> VNĐ
            </p>
            <p class="payment3">
                <a class="next" class="next" data-dismiss="modal" aria-hidden="true" title="Tiến hành thanh toán">Tiếp tục mua hàng</a>
                <?php if($cartQuantity > 0) :?>
                <a class="pay" href="<?= UrlUtil::getCheckoutUrl();?>" title="Tiến hành thanh toán">Thanh toán</a>
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>