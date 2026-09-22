document.addEventListener('DOMContentLoaded', () => {
    const widget = document.getElementById('chat-widget');

    if (!widget) {
        return;
    }

    const toggle = document.getElementById('chat-toggle');
    const close = document.getElementById('chat-close');
    const panel = document.getElementById('chat-panel');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const sendButton = document.getElementById('chat-send');
    const messagesContainer = document.getElementById('chat-messages');

    const historyUrl = widget.dataset.historyUrl;
    const messageUrl = widget.dataset.messageUrl;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    let historyLoaded = false;

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function clearEmptyState() {
        const emptyState = messagesContainer.querySelector('.chat-widget__empty');

        if (emptyState) {
            emptyState.remove();
        }
    }

    function addMessage(role, content) {
        clearEmptyState();

        const message = document.createElement('div');
        message.className = `chat-message chat-message--${role}`;
        message.textContent = content;

        messagesContainer.appendChild(message);
        scrollToBottom();
    }

    function addLoading() {
        clearEmptyState();

        const loading = document.createElement('div');
        loading.className = 'chat-message chat-message--assistant chat-message--loading';
        loading.id = 'chat-loading';
        loading.textContent = 'Pensando...';

        messagesContainer.appendChild(loading);
        scrollToBottom();
    }

    function removeLoading() {
        document.getElementById('chat-loading')?.remove();
    }

    function setSending(isSending) {
        input.disabled = isSending;
        sendButton.disabled = isSending;
    }

    async function loadHistory() {
        if (historyLoaded) {
            return;
        }

        try {
            const response = await fetch(historyUrl, {
                headers: {
                    Accept: 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Não foi possível carregar o histórico.');
            }

            const data = await response.json();

            messagesContainer.innerHTML = '';

            if (data.messages.length === 0) {
                messagesContainer.innerHTML = `
                    <div class="chat-widget__empty">
                        Olá! Como posso ajudar?
                    </div>
                `;
            } else {
                data.messages.forEach((message) => {
                    addMessage(message.role, message.content);
                });
            }

            historyLoaded = true;
        } catch (error) {
            messagesContainer.innerHTML = '';
            addMessage('assistant', 'Não foi possível carregar o histórico da conversa.');
        }
    }

    async function openChat() {
        panel.hidden = false;
        toggle.setAttribute('aria-expanded', 'true');

        await loadHistory();

        input.focus();
    }

    function closeChat() {
        panel.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', () => {
        if (panel.hidden) {
            openChat();
        } else {
            closeChat();
        }
    });

    close.addEventListener('click', closeChat);

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const content = input.value.trim();

        if (!content) {
            return;
        }

        addMessage('user', content);
        input.value = '';
        addLoading();
        setSending(true);

        try {
            const response = await fetch(messageUrl, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    message: content,
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Não foi possível enviar a mensagem.');
            }

            removeLoading();
            addMessage(data.message.role, data.message.content);
        } catch (error) {
            removeLoading();
            addMessage('assistant', error.message);
        } finally {
            setSending(false);
            input.focus();
        }
    });
});