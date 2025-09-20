<div>
    <input type="text" wire:model.live="query" class="searchinput" placeholder="Search Users...">
    @if ($query !== '')
        @forelse ($users as $user)
            <div class="member-info">
                <div class="member-left">
                    <img src="{{ getAvatar($user->name) }}" alt="{{ $user->name }}" class="member-avatar">
                    <div class="member-details">
                        <h3 class="member-name">{{ $user->name }}</h3>
                        <span class="user-status online">Online</span>
                    </div>
                </div>
                @if (in_Array($user->id, $friendsIds))
                    <button type="button" class="button-disabled" style="background-color: gray ">
                        <span class="button__text">Already Friends</span>
                    </button>
                @else
                    <button x-on:friendAdded ='disabled' type="button" class="button"
                        wire:click="addFriend({{ $user->id }})">
                        <span class="button__text">Add Friend</span>
                        <span class="button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24"
                                fill="none" class="svg">
                                <line y2="19" y1="5" x2="12" x1="12"></line>
                                <line y2="12" y1="12" x2="19" x1="5"></line>
                            </svg>
                        </span>
                    </button>
                @endif
            </div>
        @empty
            <p style="padding: 10px; color: #666;">No users found</p>
        @endforelse
    @endif
    <style>
        .searchinput {
            border: none;
            padding: 1rem;
            border-radius: 1rem;
            background: #e8e8e8;
            box-shadow: 20px 20px 60px #c5c5c5, -20px -20px 60px #ffffff;
            transition: 0.3s;
            width: 90%;
            max-width: 300px;
            margin: 10px
        }

        .searchinput:focus {
            outline-color: #e8e8e8;
            background: #e8e8e8;
            box-shadow: inset 20px 20px 60px #c5c5c5, inset -20px -20px 60px #ffffff;
            transition: 0.3s;
        }

        .button {
            /* Base Button Styles */
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 5px 10px;
            border: 1px solid #28a745;
            background-color: #28a745;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            overflow: hidden;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .button .button__text {
            transform: translateX(0);
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .button .button__icon {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: #218838;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .button .svg {
            width: 20px;
            stroke: #fff;
            stroke-width: 2;
        }

        /* Hover State */
        .button:hover {
            background: #218838;
            border-color: #218838;
        }

        .button:hover .button__text {
            transform: translateX(100%);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.3s ease-out;
        }

        .button:hover .button__icon {
            transform: translateX(0);
        }

        /* Active State */
        .button:active {
            transform: scale(0.95);
            background-color: #1e7e34;
            border-color: #1e7e34;
        }

        .member-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* left side (avatar+name) | right side (button) */
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .member-left {
            display: flex;
            align-items: center;
            gap: 10px;
            /* spacing between avatar and name */
        }

        .button-disabled {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            /* keep text centered */
            padding: 5px 10px;
            border: 1px solid gray;
            background-color: gray;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            border-radius: 8px;
            cursor: not-allowed;
            /* show disabled cursor */
        }

        /* prevent hover/transition effects */
        .button-disabled:hover .button__text {
            transform: none;
            opacity: 1;
        }
    </style>
</div>
