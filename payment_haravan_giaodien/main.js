/*
   CẤU TRÚC TÙY BIẾN
   Hiện tại API gửi mail em đang làm có API free để test. Web: https://elasticemail.com/email-api-pricing#comparisonSection
*/
function sendEmail() {
    const email = document.getElementById("checkout_user_email").value;
    const nameUser = document.getElementById("billing_address_full_name").value;
    const phoneUser = document.getElementById("billing_address_phone").value;
    Email.send({
        Host: "smtp.elasticemail.com",
        Username: "tran.hoang.nhu.1997@gmail.com",  //tài khoản mail đăng ký trên trang get api
        Password: "C8CD52DA26D1A8C6E92C13C5EE560200A168",  //  key password được lấy về sau khi đăng ký thành công
        Port: 2525, //  key port được lấy về sau khi đăng ký thành công
        To: email,  //email người nhận ( có thể nhiều người )
        From: "tran.hoang.nhu.1997@gmail.com", //email người gửi ( 1 người)
        Subject: "Chúc mừng bạn đã đăng ký ecard thành công", //Tiêu đề
        Body: `Sau khi công ty zintech gọi đến số điện thoại: ${phoneUser}. Xin mời quý khách ${nameUser} đến nhận thẻ ecard. 
               Chúng tôi xin chân thành cảm ơn!`, //Nội dung
        })
        .then(function (message) {
            console.log(email, nameUser, phoneUser);
        alert("Chúc mừng bạn đã đăng ký thành công, xin vui lòng kiểm tra email để nhận được thông báo mới nhất!")  // Dòng thông báo sau khi gửi thành công email
    });
  }