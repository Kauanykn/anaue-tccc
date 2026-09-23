<div
    class="chat-widget"
    id="chat-widget"
    data-history-url="{{ route('chat.history') }}"
    data-message-url="{{ route('chat.messages.store') }}"
>
    <button
        class="chat-widget__toggle"
        id="chat-toggle"
        type="button"
        aria-label="Abrir assistente virtual"
        aria-expanded="false"
    >
        <i class="fa-solid fa-comment-dots"></i>
    </button>

    <section class="chat-widget__panel" id="chat-panel" hidden>
        <header class="chat-widget__header">
            <div class="chat-widget__identity">
                <img
                    class="chat-widget__avatar"
                    src="{{ asset('images/mascote-gato.png') }}"
                    alt=""
                    onerror="this.hidden = true"
                >
                <div class="chat-widget__identity-copy">
                    <strong>Mia, Mascote Inteligente Anauê 🐱</strong>
                    <span>Seu ajudante para planejar a festa!</span>
                </div>
            </div>

            <button
                class="chat-widget__close"
                id="chat-close"
                type="button"
                aria-label="Fechar chat"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>

        <div class="chat-widget__messages" id="chat-messages" aria-live="polite">
            <div class="chat-widget__empty">Olá! Como posso ajudar?</div>
        </div>

        <form class="chat-widget__form" id="chat-form">
            @csrf

            <label class="sr-only" for="chat-input">Digite sua pergunta</label>

            <textarea
                id="chat-input"
                name="message"
                rows="1"
                maxlength="1000"
                placeholder="Digite sua dúvida..."
                required
            ></textarea>

            <button id="chat-send" type="submit" aria-label="Enviar mensagem">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>
    </section>
</div>
