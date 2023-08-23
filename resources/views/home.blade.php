<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <style>
        body {
            margin: 0;
            padding-bottom: 3rem;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .bottom_bar {
            background: rgba(0, 0, 0, 0.15);
            padding: 0.25rem;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            height: 3rem;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
        }

        #messageInput {
            border: none;
            padding: 0 1rem;
            flex-grow: 1;
            border-radius: 2rem;
            margin: 0.25rem;
        }

        #sendButton {
            background: #333;
            border: none;
            padding: 0 1rem;
            margin: 0.25rem;
            border-radius: 3px;
            outline: none;
            color: #fff;
        }

        #messageInput:focus {
            outline: none;
        }

        #messagesList {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messagesList>li {
            padding: 0.5rem 1rem;
        }

        #messagesList>li:nth-child(odd) {
            background: #efefef;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <ul id="messagesList"></ul>
    <div class="bottom_bar">
        <input id="messageInput" autocomplete="off" placeholder="Type a message" />
        <button id="sendButton">Send</button>
    </div>

</body>

</html>