<div>
    <main class="main-content">
        <div class="chat-header">
            <div class="chat-info">
                <img src="{{ getAvatar($friend->name) }}" alt="{{ $friend->name }}" class="chat-avatar">
                <div class="user-details">
                    <h3 class="user-name">{{ $friend->name }}</h3>
                    <span class="user-status online">{{ ucfirst($friend->status) }}</span>
                </div>
            </div>
        </div>

        <div class="messages-container" id="messagesContainer">
            <div class="messages-list" id="messagesList">
                @foreach ($messages as $message)
                    <div class="message {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}"
                        data-message-id="{{ $message->id }}">
                        @if ($message->sender_id !== auth()->id())
                            <img src="{{ getAvatar($message->sender->name) }}" alt="{{ $message->sender->name }}"
                                class="message-avatar">
                        @endif
                        <div class="message-content">
                            <div class="message-bubble">
                                {{-- @if ($message->type === 'image')
                                        <img src="{{ asset('storage/' . $message->file_path) }}" alt="Image"
                                            class="message-image">
                                    @elseif($message->type === 'file')
                                        <div class="message-file">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path
                                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z">
                                                </path>
                                            </svg>
                                            <div class="file-info">
                                                <span class="file-name">{{ $message->file_name }}</span>
                                                <span class="file-size">{{ number_format($message->file_size / 1024, 1) }}
                                                    KB</span>
                                            </div>
                                        </div>
                                    @endif --}}
                                @if ($message->body)
                                    <p class="message-text">{{ $message->body }}</p>
                                @endif
                            </div>
                            <div class="message-meta">
                                <span class="message-time">{{ $message->created_at->format('H:i') }}</span>
                                {{-- @if ($message->reactions->count() > 0)
                                    <div class="message-reactions">
                                        @foreach ($message->reactions->groupBy('emoji') as $emoji => $reactions)
                                            <span class="reaction" data-emoji="{{ $emoji }}">
                                                {{ $emoji }} {{ $reactions->count() }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="typing-indicator" id="typingIndicator" style="display: none;">
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <span class="typing-text">Someone is typing...</span>
        </div>
        {{-- method="POST"
                action="{{ route('user.sendMessage', $friend->id) }}" --}}
        <div class="message-input-container">
            <form id="messageForm" wire:submit = 'sendMessage' class="message-form" enctype="multipart/form-data">
                <div class="message-input">
                    <input type="text" wire:model = 'body' name="body" id="messageInput"
                        placeholder="Type a message..." autocomplete="off">
                </div>

                <button type="submit" class="btn-send" id="sendButton">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                    </svg>
                    <div wire:loading class="spinner-border text-primary" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </button>
            </form>
        </div>
    </main>
</div>
