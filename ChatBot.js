
document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.getElementById('message-input');
    var sendBtn = document.getElementById('send-btn');

    textarea.addEventListener('input', function() {
        if (textarea.value.trim() !== '') {
            sendBtn.style.visibility = 'visible';
        } else {
            sendBtn.style.visibility = 'hidden';
        }
    });
});


const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
const chatBox = document.querySelector(".chatbox");
const chatbotToggler = document.querySelector(".chatbot-toggler");
const chatbotCloseBtn = document.querySelector(".chatbotclose-btn");




let userMessage;
const API_KEY = "";//have to add API_KEY
const chatInputHeight = chatInput.scrollHeight;



const createChatLi = (message, className) => {
    // Creat a chat <li> element with passed message and className
    const ChatLi = document.createElement("li");
    ChatLi.classList.add("chat" , className);
    let chatContent = className === "outgoing" ? `<p></p>`: `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    ChatLi.innerHTML = chatContent;
    ChatLi.querySelector("p").textContent = message;
    return ChatLi;
}

const generateResponse = (incomingChatLi) => {
    const API_URL="https://api.openai.com/v1/chat/completions";
    const messageElement = incomingChatLi.querySelector("p");

    // Define the properties and message for the API requst
    const requestOptions = {
        method: "POST", 
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages:[{
                role: "user",
                content: userMessage
            }]
        })
    }

    // Send POST requsted to API_KEY, get response
    fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
        messageElement.textContent = data.choices[0].message.content;
    }).catch((error) => {
        messageElement.classList.add("errorstyle");
        messageElement.textContent = "Oops! Somthing went wrong. Please try again.";
    }).finally(() => chatBox.scrollTo(0, chatBox.scrollHeight));
}


const handleChat = () => {
    userMessage = chatInput.value.trim();
    if(!userMessage) return;
    chatInput.value = "";
    chatInput.style.height = `${chatInputHeight}px`; // Resetting the textarea height to its default height once the message is sent

    // Append the user's message to the chatbox
    chatBox.appendChild(createChatLi(userMessage, "outgoing"));
    chatBox.scrollTo(0, chatBox.scrollHeight);


    setTimeout(() => {
        // Display "يفكر..." message while waiting for the response
        const incomingChatLi = createChatLi("يفكر...","incoming");
        chatBox.appendChild(incomingChatLi);
        chatBox.scrollTo(0, chatBox.scrollHeight);
        generateResponse(incomingChatLi);
    }, 600);
}

chatInput.addEventListener("input", () => {
    // Adjust the height of the input textarea based on its content 
    chatInput.style.height = `${chatInputHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});

chatInput.addEventListener("keydown", (e) => {
    // If Enter key is pressed without shift key and the window 
    // width is greater than 800px, handle tha chat
    if(e.key === "Enter" &&!e.shiftKey && window.innerWidth > 800){
        e.preventDefault();
        handleChat();
    }
});

sendChatBtn.addEventListener("click", handleChat);
chatbotCloseBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));


