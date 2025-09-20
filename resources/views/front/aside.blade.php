<aside class="sidebar">
    <div class="sidebar-header">
        <div class="user-info">
            <img src="{{ getAvatar(Auth::user()->name) }}" alt="{{ Auth::user()->name }}" class="user-avatar">
            <div class="user-details">
                <h3 class="user-name">{{ Auth::user()->name }}</h3>
                <span class="user-status online">Online</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="btn-icon" title="Sign out">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16,17 21,12 16,7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </button>
        </form>
    </div>
    {{-- START: NEW Search Bar --}}
    @livewire('search-bar')
    {{-- END: NEW Search Bar --}}
    <div class="sidebar-content">
        <div class="sidebar-section">
            <div class="section-header">
                <h4 class="section-title">Direct Messages</h4>
            </div>
            <div class="contacts-list">
                @forelse(Auth::user()->allfriends() as $friend)
                    <a href="{{ route('user.chat', ['id' => $friend->id]) }}" style="text-decoration: none">
                        <div style="display: flex; align-items: center;">
                            <div class="contact-avatar" style="margin-right: 12px ; margin-left: 12px">
                                <img src="{{ getAvatar($friend->name) }}" alt="{{ $friend->name }}">
                            </div>
                            <div class="contact-info">
                                <span class="contact-name">{{ $friend->name }}</span>
                                <span class="contact-status">
                                    @if ($friend->is_online)
                                        Online
                                    @else
                                        Last seen
                                        {{ $friend->last_seen_at ? $friend->last_seen_at->diffForHumans() : 'a while ago' }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">
                        <p>No conversations yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="sidebar-section">
            <div class="section-header">
                <h4 class="section-title">Groups</h4>
            </div>
            <div class="contacts-list">
            </div>
        </div>
    </div>
</aside>
