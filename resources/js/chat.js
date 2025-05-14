import "./bootstrap.js";

window.handleApply = function (id) {
  const form = document.querySelector(`#chat-box-${id}`);
  const message = document.querySelector(`#chat-box-${id}-message`);

  const ulElement = document.querySelector(`#chat-box-ul-${id}`);
  const contentWrapper = ulElement.querySelector(".simplebar-content");

  if (!message.value.trim()) {
    alert("Vui lòng nhập tin nhắn.");
    message.focus();
    return;
  }
  const data = {
    conversation_id: id,
    sender_id: window.user.id,
    sender_type: "Admin",
    message: message.value,
  };

  const formData = new FormData();

  formData.append("conversation_id", id);
  formData.append("sender_id", window.user.id);
  formData.append("sender_type", senderType);
  formData.append("message", message.value);

  const currentTime = new Date().toLocaleTimeString([], {
    hour: "2-digit",
    minute: "2-digit",
  });

  const messageElement = createMessageElement({
    id: id,
    senderName: userCurrent.name,
    message: message.value,
    time: currentTime,
    senderType: senderType,
  });

  contentWrapper.innerHTML += messageElement;
  message.value = "";

  axios
    .post(`${APP_URL}`, formData, {
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

function createMessageElement({
  id,
  senderName,
  message,
  time,
  senderType = "Admin",
}) {
  let li = "";

  const rightClass = senderType === "Admin" ? "right" : "";

  li = `
    <li class='${rightClass}'>
      <div class="conversation-list">
        <div class="dropdown">
          <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="chat.html#">Copy</a>
              <a class="dropdown-item" href="chat.html#">Save</a>
              <a class="dropdown-item" href="chat.html#">Forward</a>
              <a class="dropdown-item" href="chat.html#">Delete</a>
            </div>
        </div>
        <div class="ctext-wrap">
          <div class="conversation-name">${senderName}</div>
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
}

Echo.channel(`conversation.${channelId}`).listen("ChatMessage", (e) => {
  console.log(e);

  const ulElement = document.querySelector(`#chat-box-ul-${channelId}`);
  const contentWrapper = ulElement.querySelector(".simplebar-content");

  const messageElement = createMessageElement({
    id: channelId,
    senderName: e.sender_name,
    message: e.message,
    time: e.created_at,
    senderType: e.sender_type,
  });

  contentWrapper.innerHTML += messageElement;
});

console.log("role");
console.log(senderType);
console.log("user");

console.log(userCurrent.name);
