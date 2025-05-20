import "./bootstrap.js";

const conversationId = localStorage.getItem("conversation_id");

const renderViewChat = ({
  id,
  senderName,
  message,
  time,
  senderType = "Admin",
}) => {
  let li = "";
  const rightClass = senderType === "Admin" ? "right" : "";

  li = `
    <li class="${rightClass}">
      <div class="conversation-list">
        <div class="ctext-wrap">
          <div class="conversation-name">
            ${senderName}
          </div>
          <p>
            ${message}
          </p>
          <p class="chat-time mb-0">
            <i class="bx bx-time-five align-middle me-1"></i>
            ${time}
          </p>
        </div>
      </div>
    </li>
    `;

  return li;
};

const renderViewChatList = (data) => {
  return data.messages
    .map((message) => {
      const rightClass =
        message.sender_type === "Admin" ? "text-end" : "text-start";
      return `
        <li>
            <div class="conversation-list ${rightClass}" >
                <div class="ctext-wrap">
                    <div class="conversation-name">
                      ${message.sender.name}
                    </div>
                    <p>
                      ${message.message}
                    </p>
                      <p class="chat-time mb-0">
                        <i class="bx bx-time-five align-middle me-1"></i>
                          20 phút
                      </p>
                  </div>
            </div>
        </li>
    `;
    })
    .join("");
};

Echo.channel(`conversation.${conversationId}`).listen("ChatMessage", (e) => {
  console.log(e);

  const ulElement = document.querySelector(`.box-chat-client-ul`);

  const messageElement = renderViewChat({
    id: conversationId,
    senderName: e.sender_name,
    message: e.message,
    time: e.created_at,
    senderType: e.sender_type,
  });

  ulElement.innerHTML += messageElement;
});

// console.log(userCurrent);


fetch(`${APP_URL}/api/conversation/${userCurrent.id}/detail`, {})
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data.data);



    localStorage.setItem("conversation_id", data.data.id);

    const ulElement = document.querySelector(`.box-chat-client-ul`);

    const messageElement = renderViewChatList(data.data);
    ulElement.innerHTML += messageElement;
  })
  .catch((error) => {
    console.log(error);
  });

window.handleApply = (id) => {
  const message = document.querySelector(`#chat-client-message`);
  const ulElement = document.querySelector(`.box-chat-client-ul`);

  if (!message.value.trim()) {
    alert("Vui lòng nhập tin nhắn.");
    message.focus();
    return;
  }

  const formData = new FormData();
  formData.append("conversation_id", conversationId);
  formData.append("sender_id", window.user.id);
  formData.append("sender_type", "User");
  formData.append("message", message.value);

  const currentTime = new Date().toLocaleTimeString([], {
    hour: "2-digit",
    minute: "2-digit",
  });

  const messageElement = renderViewChat({
    id: 1,
    senderName: window.user.name,
    message: message.value,
    time: currentTime,
    senderType: "User",
  });
  ulElement.innerHTML += messageElement;
  message.value = "";

  axios
    .post(`${APP_URL}/api/chats/${conversationId}/write`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
        Accept: "application/json",
      },
    })
    .then((response) => {
      return response.data;
    })
    .then((data) => {
      return data.data;
    })
    .then((result) => {
      console.log(result);
    })
    .catch((err) => {
      console.log(err);
    });
};
