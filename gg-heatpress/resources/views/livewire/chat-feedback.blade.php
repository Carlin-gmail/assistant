<div>
    {{-- CHAT /FEEDBACK --}}
    <button class="chat-button" id="chat-button" aria-label="Open">
    Feedback
    </button>

    <aside class="chat" id="chat" aria-label="Chat dialog">

        <!-- Header -->
        <header class="chat-header">
            <h2 class="chat-title">Support</h2>
            <button class="chat-close" id="chat-close" aria-label="Close chat">×</button>
        </header>

        <!-- Messages area -->
        <section class="chat-messages" aria-live="polite">

            <article class="message message--agent">
                {{-- <p>{{$agentMessage}}</p> --}}
                <time datetime="2026-01-04T10:00">10:00</time>
            </article>

            <article class="message message--user">
                <p>{{ $userMessage }}</p>
                <time datetime="2026-01-04T10:01">10:01</time>
            </article>

        </section>

        <!-- Input / composer -->
        <form class="chat-input" wire:submit.prevent="sendMessage">
            <label for="chat-message" class="sr-only">Type a message</label>
            <input
                id="chat-message"
                name="userMessage"
                class="chat-input-message"
                type="text"
                placeholder="Type a message…"
                wire:model.defer="userMessage"
            >
            <button type="submit" class="hidden">Send</button>
        </form>
    </aside>
</div>
