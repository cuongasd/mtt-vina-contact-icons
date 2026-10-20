# MTT VINA Contact Icons 1.0.0

Cài đặt: Plugin → Cài mới → Tải plugin lên → chọn mtt-vina-contact-icons-1.0.0.zip → Cài đặt → Kích hoạt.

Plugin đổi hai nút liên hệ hiện có thành icon tròn 52px, giữ màu, vị trí và đường dẫn gốc. Không thêm nút nếu website không có cấu trúc phù hợp. Không có trang cấu hình hay lưu dữ liệu.

Hoàn tác: Vô hiệu hóa plugin, làm mới cache website nếu có và tải lại trang.

Cập nhật: tải ZIP phiên bản mới qua cùng giao diện, chọn thay thế phiên bản cũ khi WordPress yêu cầu.

Kiểm tra sau cài: xem trang chủ và trang tin tức trên máy tính/điện thoại; đối chiếu link Zalo và tel; kiểm tra phím Tab và nhãn nút. Không cần thực hiện cuộc gọi.

## Cập nhật từ GitHub
Repo: https://github.com/cuongasd/mtt-vina-contact-icons
Phiên bản tích hợp updater: 1.1.0. Thư viện PUC 5.7 được ghim trong DEPENDENCIES.md.
Cài ZIP 1.1.0 thay thế plugin cũ một lần, rồi bật tự cập nhật riêng MTT VINA Contact Icons.
WordPress cần quyền ghi plugin, HTTPS ra GitHub và tác vụ định kỳ hoạt động. Không cần token cho repo công khai.
Chỉ nhận stable Release có file mtt-vina-contact-icons-X.Y.Z.zip; không lấy branch/tag dự phòng.
Kiểm tra mặc định khoảng 12 giờ; tự cài còn phụ thuộc lịch WordPress. Không đồng bộ tức thì khi lưu file.

## Phát hành
Tăng phiên bản ở header PHP, hằng MTT_VINA_CONTACT_ICONS_VERSION và Stable tag trong readme.txt.
Cập nhật changelog. Chạy node tests/contact-icons.cjs và php -l trên PHP.
Commit/push main, chờ kiểm thử GitHub Actions, tạo và push tag vX.Y.Z.
Workflow kiểm tra PHP 7.2/8.3, JavaScript và đóng ZIP; tạo Release khi kiểm thử đạt.
Không sửa nội dung hoặc ZIP của Release đã phát hành; luôn tăng phiên bản.

## Hoàn tác
Giữ ZIP 1.0.0 và bản tốt gần nhất ngoài repo. Nếu lỗi, tắt tự cập nhật riêng plugin rồi cài lại ZIP bản tốt qua WordPress; làm mới cache.
Nếu cần tự cập nhật bản sửa, phát hành nội dung bản tốt với số phiên bản cao hơn.
GitHub lỗi mạng không đổi code đang cài; updater sẽ thử lại theo lịch.
