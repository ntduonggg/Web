👜 Website Thương mại điện tử - PHP MySQL
---------------------------------------------
🌐 Giới thiệu

Dự án Website Thương mại điện tử là một ứng dụng web được xây dựng bằng PHP và MySQL, cho phép người dùng mua sắm trực tuyến các sản phẩm túi xách, trang sức.
Trang web bao gồm giao diện người dùng (client) và trang quản trị (admin) giúp quản lý sản phẩm, khách hàng và đơn hàng dễ dàng.

---------------------------------------------

🧩 Công nghệ sử dụng

- Ngôn ngữ: PHP
- Cơ sở dữ liệu: MySQL (file web.sql)
- Giao diện: HTML, CSS, JavaScript
- Môi trường chạy: XAMPP / Laragon / WAMP
---------------------------------------------
🛍️ Chức năng người dùng (Client)
| File           | Mô tả                                                                |
| -------------- | -------------------------------------------------------------------- |
| `index.php`    | Trang chủ hiển thị danh sách sản phẩm túi xách.                      |
| `detail.php`   | Xem chi tiết sản phẩm (hình ảnh, giá, mô tả, nút thêm vào giỏ hàng). |
| `cart.php`     | Quản lý giỏ hàng: thêm, xóa, cập nhật sản phẩm.                      |
| `payment.php`  | Thanh toán đơn hàng.                                                 |
| `sign-in.php`  | Đăng nhập người dùng.                                                |
| `sign-up.php`  | Đăng ký tài khoản mới.                                               |
| `logout.php`   | Đăng xuất tài khoản.                                                 |
| `about-us.php` | Giới thiệu về cửa hàng.                                              |
| `product.php`  | Trang hiển thị tất cả sản phẩm (phân loại hoặc tìm kiếm).            |

---------------------------------------------
🔐 Chức năng quản trị (Admin)
| File                  | Mô tả                                                    |
| --------------------- | -------------------------------------------------------- |
| `index.php`           | Trang tổng quan (dashboard) hiển thị thông tin hệ thống. |
| `customer.php`        | Quản lý danh sách khách hàng.                            |
| `edit_customer.php`   | Sửa thông tin khách hàng.                                |
| `delete_customer.php` | Xóa khách hàng.                                          |
| `product.php`         | Quản lý danh sách sản phẩm túi xách.                     |
| `edit_product.php`    | Chỉnh sửa sản phẩm.                                      |
| `delete_product.php`  | Xóa sản phẩm.                                            |
| `order.php`           | Quản lý đơn hàng của khách.                              |
| `print_order.php`     | In hóa đơn đơn hàng.                                     |
| `header.php`          | Header dùng chung cho trang quản trị.                    |
| `logout.php`          | Đăng xuất tài khoản admin.                               |

