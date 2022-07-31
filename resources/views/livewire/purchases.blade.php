<div class="purchasesContainer">
    <div class="purchasesTable">
        @if (count($purchases))
            <div class="noPurchases">
                <p class="bold">AVISO.</p>
                <span>
                    Si deseas pedir un reembolso de alguno de nuestros productos, estaremos encantados de atenderte.
                </span>
                <span>
                    Solo contáctanos por cualquier medio enlistado en nuestra
                </span>
                <a href="{{route('contact')}}" class="noPurchasesLink">página de contacto.</a>
            </div>
            <div class="purchaseRow indexRow">
                <div class="tableProperties">
                    <p class="tableProperty">ID de compra</p>
                    <p class="tableProperty">Total</p>
                    <p class="tableProperty">Fecha de orden</p>
                    <p class="tableProperty">Estado</p>
                </div>
            </div>
        @else
            <div class="noPurchases">
                <span>No hay compras en tu cuenta</span>
                <a href="{{route('products')}}" class="noPurchasesLink">haz click aquí para ir a comprar</a>
            </div>
        @endif
        @foreach ($purchases as $purchase)
            @if ($selectedDetails !== $purchase->id)
                <div class="purchaseRow {{($selectedDetails === $purchase->id)? 'borderBottom': ''}}">
                    <div class="tableProperties">
                        <p class="tableProperty">{{$purchase->id}}</p>
                        <p class="tableProperty">${{number_format($purchase->total, 2)}}mxn</p>
                        <p class="tableProperty">{{$purchase->created_at}}</p>
                        <p class="tableProperty">{{$purchase->status}}</p>
                    </div>
                    <div class="detailsButton" wire:click="details({{$purchase->id}})">Ver detalles</div>
                </div>
            @else
                <div class="purchaseRow borderBottom">
                    <div class="tableProperties">
                        <p class="tableProperty">{{$purchase->id}}</p>
                        <p class="tableProperty">${{number_format($purchase->total, 2)}}mxn</p>
                        <p class="tableProperty">{{$purchase->created_at}}</p>
                        <p class="tableProperty">{{$purchase->status}}</p>
                    </div>
                    <div class="detailsButton" wire:click="hideDetails">Ocultar detalles</div>
                </div>
                <div class="purchaseRow indexRow productDetails">
                    <div class="tableProperties">
                        <p class="tableProperty">Nombre del producto</p>
                        <p class="tableProperty">Precio de compra</p>
                        <p class="tableProperty">Cantidad</p>
                        <p class="tableProperty">Subtotal</p>
                        <p class="tableProperty">Estado</p>
                    </div>
                </div>
                @foreach ($purchaseDetails as $purchaseDetail)
                    <div class="purchaseRow productDetails">
                        <div class="tableImage">
                            <a href="{{route('product-overview', Str::slug($purchaseDetail->purchased_name))}}">
                                <img
                                    class="fixedImage"
                                    src="{{asset('storage/' . $purchaseDetail->purchased_image)}}"
                                    alt="{{$purchaseDetail->purchased_image_alt}}">
                            </a>
                        </div>
                        <div class="tableProperties">
                            <div class="tableProperty">
                                <a href="{{route('product-overview', Str::slug($purchaseDetail->purchased_name))}}">
                                    {{$purchaseDetail->purchased_name}}
                                </a>
                            </div>
                            <p class="tableProperty">${{number_format($purchaseDetail->purchased_price, 2)}}mxn</p>
                            <p class="tableProperty">{{$purchaseDetail->quantity}}</p>
                            <p class="tableProperty">${{number_format($purchaseDetail->subtotal, 2)}}mxn</p>
                            <p class="tableProperty">{{$purchaseDetail->status}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
