# Vidu về 1 module nhỏ xử lý trừ tiền 1 thuê bao và bảo mật dữ liệu

## Source Code
Sử dụng git và pull code từ địa chỉ sau: https://github.com/thanhth89/sample_module_atb.git
### Môi Trường
Cài đặt Xampp (version php >= 5.3.4 ,Mysql)

### Cài đặt

- Import file sql sample_atb.sql
- Cấu hình vitualhost ở thư mục /sample_module_atb/api/www
vidu 
<VirtualHost *:80>
        ServerAdmin "webmaster@dummy-host.example.com"
        ErrorLog "logs/dummy-host.example.com-error.log"
        ServerName module_sample.api
        ServerAlias module_sample.api
        DocumentRoot "/sample_module_atb/api/www/api/www"
        <Directory "/sample_module_atb/api/www/api/www">
                Options Indexes FollowSymLinks MultiViews
    AllowOverride all
    Order Deny,Allow
    Allow from all
    Require all granted
        </Directory>
</VirtualHost>

- config thông tin Database ở file \sample_module_atb\common\config\db.php

## Các bước test

- Khởi tạo chữ ký và data dữ liệu được mã hóa qua URL sau: http://module_sample.api/client
- copy toàn bộ dữ liệu đươc trả về
vidu : http://module_sample.api/charge?data=HfuIyA09mxcOi1ldJRXWpCBKy3GP1cB%2BHHm6%2BSqlIOr%2F8oEg3y8LBXACBlsFE7MC43c%2FZeIzZl8QtNU1a2NnIbzrhs2opD3%2FAFD6waHyEj%2FVXP1GzoiZdeD42tam7eVME40Y2GQGsnJ65OfvBU2gBD74e7FR55gkrNFj%2FrnmFPA%3D&signature=msIT%2Bw62d6bSsJjdHs50CKs%2F9gVTxP7kYP2l7BnBqnQ3SOlrgHMU7S%2F%2FFpQdxjvD4%2B0Dekz13jSkNX%2BeHdlSvNTPnPYZkiYQMXBRrLARd%2FaeWz2Vs0XkqwPwz5nkjqCSJp97cVLVIPZnotz22NMyGPCBBCgaC5apu%2FP8RjB5uEk%3D

- open url đã copy vào 1 cửa sổ mới nếu trả về response {"code":0,"message":"Success"} là thành công

### Giải thích code

 - Url http://module_sample.api/client được thể hiện như 1 client muốn request 1 yêu cầu lên 1 service server (URL http://module_sample.api/charge)
 Mỗi dữ liệu request được mã hóa và được kí số với thuật toán mã hóa RSA.
 + Tham số {data} dữ liệu cần xử lý.
 + Tham số {signature} là chữ ký tương ứng với dữ liệu trên
 
 
 Vidu ở đây là hành động thuê bao 0369803686 muốn xem 1 video thì cần phải trừ cước phí là 5000.
 Luồng xử lý sẽ check toàn vẹn dữ liệu,check tài khoản hiện tại ở table amount.
 Nếu số dư lớn >=5000 thì tiến hành trừ cước và đồng thời lưu log giao dịch vào table transaction.
 mỗi 1 request sẽ có 1 request_id riêng và chỉ được thực hiện 1 lần.
 Trường hợp 1 request mà bị loop nhiều lần sẽ bị chặn.
 Việc bảo mật này có thể thêm xử lý bảo mật ở header và thời gian timeout

## Authors

LETHANH

## Cảm ơn Quý bạn đã sử dụng thử source code này