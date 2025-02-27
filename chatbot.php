



<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="ChatBot.css">
    <script src="ChatBot.js" defer></script>


    <title>Chatbot</title>
</head>
<body>
    <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
        <header>
            <h2>روبوت المحادثة</h2>
            <span class="chatbotclose-btn material-symbols-outlined">close</span>
        </header>
        <ul class="chatbox">
            <li class="chat incoming">
                <span class="material-symbols-outlined">smart_toy</span>
                <p>مرحبًا 👋 <br> كيف يمكنني مساعدتك اليوم؟</p>
            </li>
        </ul>
        <div class="chat-input">
            <span id="send-btn" class="material-symbols-outlined">send</span>
            <textarea placeholder="أدخل رسالة..." id="message-input"></textarea>
        </div>
    </div>
</body>
</html>