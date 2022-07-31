<div class="reviews">
    @if (count($productGeneral->reviews) > 0)
        <div class="userComments">
            <div class="userCommentsContainer">
                @foreach ($productGeneral->reviews as $review)
                    <div class="userComment">
                        <h3 class="userName">{{$review->user->name}}</h3>
                        <div class="rateIcons userRate">
                            @for ($i = 0; $i < round($review->review); $i++)
                                    <i class="fas fa-star rateIcon"></i>
                            @endfor
                            @for ($i = round($review->review); $i < 5; $i++)
                                <i class="far fa-star rateIcon"></i>
                            @endfor
                        </div>
                        @if ($review->comment)
                            <p class="comment">{{$review->comment}}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="userComments">
            <p class="comment noComment">No hay comentarios por mostrar</p>
        </div>
    @endif
    <div class="newComment">
        @auth
            @if (Auth::user()->user_type === 'user.noComment')
                <h3>Lo sentimos, has sido bloqueado de la sección de comentarios</h4>
            @else
                @if ($previousReview)
                    <h3>Gracias por darnos tu opinión</h3>
                    <div class="rateIcons newRate">
                        @for ($i = 0; $i < 5; $i++)
                            <input type="radio" name="rate" id="rate{{5 - $i}}" class="rateInput" value="{{5 - $i}}" wire:model="rate">
                            <label for="rate{{5 - $i}}" class="rateIcon"><i class="fas fa-star"></i></label>
                        @endfor
                    </div>
                    <textarea 
                        name="newCommentField" 
                        id="newCommentField"
                        placeholder="Agrega un comentario a tu reseña"
                        wire:model="comment"
                    ></textarea>
                    <div class="commentButtons">
                        <div 
                            id="eraseCommentButton"
                            class="commentButton eraseComment"
                            wire:click="deleteReview"
                            wire:loading.remove
                            wire:target="deleteReview, updateReview">
                            Eliminar comentario
                        </div>
                        <div 
                            id="updateCommentButton"
                            class="commentButton updateComment" 
                            wire:click="updateReview"
                            wire:loading.remove
                            wire:target="deleteReview, updateReview">
                            Actualizar reseña
                        </div>
                        <div 
                            id="updateCommentButtonDisabled"
                            class="disabledButton"
                            wire:loading.flex
                            wire:target="deleteReview, updateReview">
                            Actualizando comentario
                        </div>
                    </div>
                @else
                    <h3>Danos tu opinión sobre el prdcuto</h3>
                    <div class="rateIcons newRate">
                        @for ($i = 0; $i < 5; $i++)
                            <input type="radio" name="rate" id="rate{{5 - $i}}" class="rateInput" value="{{5 - $i}}" wire:model="rate">
                            <label for="rate{{5 - $i}}" class="rateIcon"><i class="fas fa-star"></i></label>
                        @endfor
                    </div>
                    <textarea 
                        name="newCommentField" 
                        id="newCommentField" 
                        placeholder="Por favor, tómate un momento para reseñar nuestro producto"
                        wire:model="comment"
                    ></textarea>
                    <div class="commentButtons">
                        <div 
                            id="createCommentButton"
                            class="commentButton" 
                            wire:click="createReview"
                            wire:loading.remove
                            wire:target="createReview">
                            Comentar
                        </div>
                        <div 
                            id="createCommentButtonDisabled"
                            class="disabledButton"
                            wire:loading.flex
                            wire:target="createReview">
                            Comentando
                        </div>
                    </div>
                @endif
            @endif
        @else
            <h3>Inicia sesión para dejar tu reseña</h4>
            <a class="commentButton" href="{{route('login')}}">Iniciar Sesión</a>
        @endauth
    </div>
</div>
