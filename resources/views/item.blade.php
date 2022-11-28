@if($newcart != null)

<div class="select-items">
    <table>
        <tbody>
            @foreach($newcart->product as $item)
            <tr>
                <td class="si-pic"><img src="assets/img/select-{{$item['productInfo']->img}}" alt=""></td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{number_format($item['productInfo']->price)}}₫ x {{$item['quanty']}}</p>
                        <h6>{{$item['productInfo']->name}}</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="select-total">
    <span>total:</span>
    <h5>{{number_format($newcart->totalPrice)}}₫</h5>
</div>
</div>
@endif