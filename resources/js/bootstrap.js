import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let meta_csrf_token = document.querySelector('meta[name="csrf-token"]');
if (meta_csrf_token != undefined) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] =
    meta_csrf_token.getAttribute("content");
}

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: "pusher",
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  wsHost: import.meta.env.VITE_PUSHER_HOST,
  wsPort: import.meta.env.VITE_PUSHER_PORT,
  wssPort: import.meta.env.VITE_PUSHER_PORT,
  forceTLS: false,
  enabledTransports: ["ws", "wss"],
  wsPath: import.meta.env.VITE_REVERB_PATH,
  authEndpoint: "/broadcasting/auth",
  auth: {
    headers: {
      "X-CSRF-TOKEN": meta_csrf_token.getAttribute("content"),
    },
  },
});
