<div>
    <div class="mailForm">
        <form action="{{route('contact.send')}}" method="POST" id="form">
            @csrf
            <div class="nameContainer inputContainer">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="nameInput" wire:model="name">
                @error('name')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="emailContainer inputContainer">
                <label for="email">Correo:</label>
                <input type="email" name="email" id="emailInput" wire:model="email">
                @error('email')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="subjectContainer inputContainer">
                <label for="subject">Asunto</label>
                <input type="text" name="subject" id="subjectInput" wire:model="subject">
                @error('subject')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="messageContainer inputContainer">
                <label for="message">Mensaje:</label>
                <textarea name="message" id="message" rows="10" wire:model="message"></textarea>
                @error('message')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" {{($disabled)? "disabled class=disabled" : "class=enabled"}}>
                {{($disabled)? "Llene todos los campos antes de enviar el correo" : "Enviar correo"}}
            </button>
        </form>
    </div>
</div>
