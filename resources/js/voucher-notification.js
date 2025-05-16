import "./bootstrap";

Echo.channel(`voucher-notification`).listen(
  "VoucherNotification",
  (voucher) => {
    console.log(voucher);

    const noticeElement = document.querySelector("#notice-voucher");
    const noticeContentElement = document.querySelector(
      "#notice-voucher-content"
    );

    /**
     * Xóa class d-none ở notice để hiển thị lên
     */
    if (noticeElement.classList.contains("d-none")) {
      noticeElement.classList.remove("d-none");

      noticeContentElement.innerHTML = `
        Bạn vừa nhận được voucher:
        <b>${voucher.code}</b>
        chúc bạn có trải nghiệm đáng nhớ
      `;
    }
    /**
     * Sau 3 giây tự động thêm d-none để ẩn
     */
    setTimeout(() => {
      noticeElement.classList.add("d-none");
    }, 3000);

    //   alert("Bạn vừa nhận được voucher");
  }
);
